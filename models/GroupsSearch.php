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
     * 
     */
    
    public $BuildingName;
    public $groupCode;
    public $subjectName;
    
    
    public function rules()
    {
        return [
            [['id', 'building_id', 'subject_id', 'group_type_id'], 'integer'],
            [['BuildingName', 'subjectName'], 'safe'],
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

    
    $attribute = "buildings.$attribute";

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
            'BuildingName' => [
                'asc' => ['buildings.alias' => SORT_ASC],
                'desc' => ['buildings.alias' => SORT_DESC]
            ],
            'groupCode' => [
                'asc' => ['building_id' => SORT_ASC, 'subject_id' => SORT_ASC, 'group_type_id' => SORT_ASC],
                'desc' => ['building_id' => SORT_DESC, 'subject_id' => SORT_DESC, 'group_type_id' => SORT_DESC],
                'label' => 'Full Name',
                'default' => SORT_ASC
            ],
             'subjectName' => [
                'asc' => ['subjects.name' => SORT_ASC],
                'desc' => ['subjects.name' => SORT_DESC]
            ],
           
            
            
        ]
    ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->joinWith(['building']);
          
            return $dataProvider;
        }

        // grid filtering conditions
        $this->addCondition($query, 'building_id');
        $query->andFilterWhere([
            'building_id' => $this->building_id,
        ]);
        
        $this->addCondition($query, 'subject_id');
        $query->andFilterWhere([
            
            'subject_id' => $this->subject_id,
            
        ]);
        
        $query->joinWith(['building' => function ($q) {
        $q->where('buildings.alias LIKE "%' . $this->BuildingName . '%"');
    }]);
         

        return $dataProvider;
    }
}
