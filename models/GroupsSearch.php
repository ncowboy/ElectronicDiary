<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Groups;

/**
 * GroupsSearch represents the model behind the search form about `app\models\Groups`.
 */
class GroupsSearch extends Groups
{
    /**
     * @inheritdoc
     */
    public $buildingName;
    public $subjectName;
    public $groupCode;
    public $teacherName;
    
    public function rules()
    {
        return [
            [['id', 'building_id', 'subject_id', 'group_type_id'], 'integer'],
            [['buildingName', 'subjectName', 'teacherName'], 'safe']
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
 
    /*
     * Для корректной работы фильтра со связью со
     * свой же моделью делаем:
     */
  //  $attribute = "buildings.$attribute";
 
    if ($partialMatch) {
        $query->andWhere(['like', $attribute, $value]);
    } else {
        $query->andWhere([$attribute => $value]);
    }
}
    public function search($params)
    {
        $query = Groups::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
        'attributes' => [
            'buildingName' => [
                'asc' => ['buildings.alias' => SORT_ASC],
                'desc' => ['buildings.alias' => SORT_DESC],
            ],
            'subjectName' => [
                'asc' => ['subjects.alias' => SORT_ASC],
                'desc' => ['subjects.alias' => SORT_DESC],
            ],
            'groupCode' => [
                'asc' => [ 'id' => SORT_ASC],
                'desc' => ['id' => SORT_DESC],
            ],
            
            'teacherName' => [
                'asc' => ['teachers.name' => SORT_ASC],
                'desc' => ['teachers.name' => SORT_DESC],
            ],
            
            
        ]
    ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->joinWith(['building'])->joinWith(['subjects'])->joinWith(['teachers']);
            return $dataProvider;
        }
       $this->addCondition($query, 'building_id');
       $this->addCondition($query, 'subject_id');
       $this->addCondition($query, 'teacher_id');
       
        // grid filtering conditions
    
        $query->joinWith(['building' => function ($q) {
        $q->where('buildings.alias LIKE "%' . $this->buildingName . '%"');
    }])->joinWith(['subject' => function ($q) {
        $q->where('subjects.alias LIKE "%' . $this->subjectName . '%"');
    }])->joinWith(['teachers' => function ($q) {
        $q->where('teachers.name LIKE "%' . $this->teacherName . '%"');
    }]);
    $query->andWhere('groups.id LIKE "%' . $this->groupCode . '%"');
    
        return $dataProvider;
    }
}
