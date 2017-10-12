<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Teachers;


class TeachersSearch extends Teachers
{ 
    public $userFullName;
    public $username;
    
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['specialization', 'username', 'userFullName'], 'safe'],
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
        $query = Teachers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
    $dataProvider->setSort([
        'attributes' => [
            'specialization' => [
                'asc' => ['specialization' => SORT_ASC],
                'desc' => ['specialization' => SORT_DESC],
            ],
            'userFullName' => [
                'asc' => [ 'users.surname' => SORT_ASC, 'users.name' => SORT_ASC, 'users.patronymic' => SORT_ASC],
                'desc' => ['users.surname' => SORT_DESC, 'users.name' => SORT_DESC, 'users.patronymic' => SORT_DESC],
            ],
            'username' => [
                'asc' => [ 'users.username' => SORT_ASC],
                'desc' => ['users.username' => SORT_DESC],
            ],
            
        ]
    ]);
        $this->load($params);

        if (!$this->validate()) {
            $query->joinWith(['users']);
            return $dataProvider;
        }
          $this->addCondition($query, 'user_id');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'specialization', $this->specialization]);
       
        
        $query->joinWith(['user' => function ($q) {
                $q->where('users.surname LIKE "%' . $this->userFullName . '%" ' .
                'OR users.name LIKE "%' . $this->userFullName . '%"' .
                'OR users.patronymic LIKE "%' . $this->userFullName . '%"'        
            )->andWhere('users.username LIKE "%' . $this->username . '%" ');
            }]);

        return $dataProvider;
    }
}
