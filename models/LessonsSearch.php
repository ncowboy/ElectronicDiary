<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lessons;

/**
 * LessonsSearch represents the model behind the search form about `app\models\Lessons`.
 */
class LessonsSearch extends Lessons
{
    /**
     * @inheritdoc
     */
    
    public $groupCode;
    public $subjectAlias;

    public function rules()
    {
        return [
            [['id', 'group_id'], 'integer'],
            [['theme', 'groupCode', 'subjectAlias'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
       protected function addCondition($query, $attribute, $partialMatch = false)
{
    if (($pos = strrpos($attribute, '.')) !== false) {
        $modelAttribute = substr($attribute, $pos + 1);
    } else {
        $modelAttribute = $attribute;
    }

    $value = $this->$modelAttribute;
    if (trim($value) === '') {
        return;
    }

    if ($partialMatch) {
        $query->andWhere(['like', $attribute, $value]);
    } else {
        $query->andWhere([$attribute => $value]);
    }
}

    public function search($params)
    {
        $query = Lessons::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
        'attributes' => [
            
            'datetime' => [
                'asc' => ['datetime' => SORT_DESC],
                'desc' => ['datetime' => SORT_ASC]
            ],
            'theme' => [
                'asc' => ['theme' => SORT_ASC],
                'desc' => ['theme' => SORT_DESC]
            ],
            'subjectAlias' => [
                'asc' => ['subjects.alias' => SORT_ASC],
                'desc' => ['subjects.alias' => SORT_DESC]
            ],
            'groupCode' => [
              'asc' => ['groups.building_id' => SORT_ASC, 'groups.subject_id' => SORT_ASC, 'group_types.type_alias' => SORT_ASC, 'groups.id' => SORT_ASC],
              'desc' => ['groups.building_id' => SORT_DESC, 'groups.subject_id' => SORT_DESC, 'group_types.type_alias' => SORT_DESC, 'groups.id' => SORT_DESC],
            ],
        ],
            'defaultOrder' => ['datetime' => SORT_ASC]
    ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->joinWith(['group']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'datetime' => $this->datetime,
            'group_id' => $this->group_id,
        ]);

        $query->andFilterWhere(['like', 'datetime', $this->datetime])
            ->andFilterWhere(['like', 'theme', $this->theme]);

        $query->joinWith(['group' => function ($q) {
          $q->where('groups.id LIKE "%' . $this->group_id . '%"');
        }])
          ->join('LEFT JOIN', 'group_types', 'groups.group_type_id = group_types.id')
          ->join('LEFT JOIN', 'subjects', 'groups.subject_id = subjects.id');

        $query->andWhere('CONCAT(
                            IF (groups.building_id < 10, 
                                CONCAT (0, groups.building_id), groups.building_id),
                            ".", 
                            IF (groups.subject_id < 10, 
                                CONCAT (0, groups.subject_id), groups.subject_id), 
                            "-", 
                            group_types.type_alias, 
                            "-", 
                            IF (groups.id < 10, 
                                CONCAT (0, groups.id), groups.id)
                            ) 
                        LIKE "%' . $this->groupCode . '%"');

        $query->andWhere('subjects.alias LIKE "%' . $this->subjectAlias . '%"');
        return $dataProvider;
    }
}
