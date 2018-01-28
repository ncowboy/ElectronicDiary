<?php

namespace app\modules\teacher\models;

use yii\data\ActiveDataProvider;
use app\models\Groups;
use app\models\GroupsSearch;
use app\models\Teachers;




class TeacherGroupsSearch extends GroupsSearch
{
    /**
     * @inheritdoc
     */
    
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
                'asc' => ['building_id' => SORT_ASC, 'subject_id' => SORT_ASC, 'id' => SORT_ASC],
                'desc' => ['building_id' => SORT_DESC, 'subject_id' => SORT_DESC, 'id' => SORT_DESC],
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
    }]);
    $query->andWhere('groups.id LIKE "%' . $this->groupCode . '%"');
    $teacher = Teachers::findOne(['user_id' => \Yii::$app->user->id]);
    $query->andWhere(['teacher_id' => $teacher->id]);

  
        return $dataProvider;
    }
}
