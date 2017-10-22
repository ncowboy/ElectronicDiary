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
    
    public $subjectAlias;
    public $groupCode;
    
    public function rules()
    {
        return [
            [['id', 'group_id', 'subject_id'], 'integer'],
            [['theme', 'subjectAlias', 'groupCode'], 'safe'],
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

    
    $attribute = "user_roles.$attribute";

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
            'subjectAlias' => [
                'asc' => ['subjects.alias' => SORT_ASC],
                'desc' => ['subjects.alias' => SORT_DESC]
            ],
            'datetime' => [
                'asc' => ['datetime' => SORT_ASC],
                'desc' => ['datetime' => SORT_DESC]
            ],
            'theme' => [
                'asc' => ['theme' => SORT_ASC],
                'desc' => ['theme' => SORT_DESC]
            ],
            'groupCode' => [
                'asc' => ['building_id' => SORT_ASC, 'subject_id' => SORT_ASC, 'id' => SORT_ASC],
                'desc' => ['building_id' => SORT_DESC, 'subject_id' => SORT_DESC, 'id' => SORT_DESC],
            ],
        ],
            'defaultOrder' => ['datetime' => SORT_ASC]
    ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['subjects'])->joinWith(['groups']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'datetime' => $this->datetime,
            'group_id' => $this->group_id,
            'subject_id' => $this->subject_id,
        ]);

        $query->andFilterWhere(['like', 'datetime', $this->datetime])
            ->andFilterWhere(['like', 'theme', $this->theme]);
        
        $query->joinWith(['subject' => function ($q) {
        $q->where('subjects.alias LIKE "%' . $this->subjectAlias . '%"');
    }]);
    $query->andWhere('lessons.group_id LIKE "%' . $this->groupCode . '%"');
        return $dataProvider;
    }
}
