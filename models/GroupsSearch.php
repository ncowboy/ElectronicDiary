<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Groups;
use app\models\Teachers;


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
    public $groupTypeCode;
    
    public function rules()
    {
        return [
            [['id', 'building_id', 'subject_id', 'group_type_id'], 'integer'],
            [['buildingName', 'subjectName', 'teacherName', 'groupCode', 'groupTypeCode'], 'safe']
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
    
    protected function addCondition($query, $attribute, $partialMatch = true)
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
        $query = Groups::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
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
                'asc' => ['building_id' => SORT_ASC, 'subject_id' => SORT_ASC, 'group_types.type_alias' => SORT_ASC, 'id' => SORT_ASC],
                'desc' => ['building_id' => SORT_DESC, 'subject_id' => SORT_DESC, 'group_types.type_alias' => SORT_DESC, 'id' => SORT_DESC],
            ],
            
        ]
    ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->joinWith(['building'])->joinWith(['subjects'])->joinWith(['group_types']);
            return $dataProvider;
        }
       $this->addCondition($query, 'building_id');
       $this->addCondition($query, 'subject_id');
       $this->addCondition($query, 'teacher_id');
       
        // grid filtering conditions
    
        $query->joinWith(['building' => function ($q) {
          $q->where('buildings.alias LIKE "%' . $this->buildingName . '%"');
        }])
              ->joinWith(['subject' => function ($q) {
                $q->where('subjects.alias LIKE "%' . $this->subjectName . '%"');
            }])
              ->joinWith(['groupType' => function ($q) {
                $q->where('group_types.type_alias LIKE "%' . $this->groupTypeCode . '%"');
              }]);

        $query->andWhere('CONCAT(IF (buildings.id < 10, CONCAT (0, buildings.id), buildings.id), ".", 
        IF (subjects.id < 10, CONCAT (0, subjects.id), subjects.id), "-", group_types.type_alias, "-", 
        IF (groups.id < 10, CONCAT (0, groups.id), groups.id)) LIKE "%' . $this->groupCode . '%"');
            return $dataProvider;
        }

}
