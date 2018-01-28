<?php

namespace app\modules\teacher\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Teachers;
use app\models\Groups;
use app\models\Lessons;
use app\models\LessonsSearch;


class TeacherLessonsSearch extends LessonsSearch
{
    /**
     * @inheritdoc
     */
    
    public $groupCode;
    
    public function rules()
    {
        return [
            [['id', 'group_id'], 'integer'],
            [['theme', 'groupCode'], 'safe'],
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
            
            'datetime' => [
                'asc' => ['datetime' => SORT_ASC],
                'desc' => ['datetime' => SORT_DESC]
            ],
            'theme' => [
                'asc' => ['theme' => SORT_ASC],
                'desc' => ['theme' => SORT_DESC]
            ],
            'groupCode' => [
                'asc' => ['id' => SORT_ASC],
                'desc' => ['id' => SORT_DESC],
            ],
        ],
            'defaultOrder' => ['datetime' => SORT_ASC]
    ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['groups'])->joinWith(['subjects']);
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
        
    
    $query->andWhere('lessons.group_id LIKE "%' . $this->groupCode . '%"');
    
    $teacher = Teachers::findOne(['user_id' => \Yii::$app->user->id]);
    $groups = Groups::findAll(['teacher_id' => $teacher->id]);
    $ids = [];       
      foreach ($groups as $value) {
        array_push($ids, $value['id']);
     }
    $query->having(['group_id' => $ids]);
    
    return $dataProvider;
    }
}
