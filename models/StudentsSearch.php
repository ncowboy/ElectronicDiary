<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Students;

/**
 * StudentsSearch represents the model behind the search form about `app\models\Students`.
 */
class StudentsSearch extends Students
{
    /**
     * @inheritdoc
     */
    public $userFullName;
    public $userName;
    public $useRole;
    
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['phone_number', 'parents_name', 'parents_number', 'parents_email', 'birth', 'userName', 'userFullName'], 'safe'],
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
        $query = Students::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
              $dataProvider->setSort([
        'attributes' => [
            'phone_number' => [
                'asc' => ['phone_number' => SORT_ASC],
                'desc' => ['phone_number' => SORT_DESC],
            ],
            'parents_name' => [
                'asc' => ['parents_name' => SORT_ASC],
                'desc' => ['parents_name' => SORT_DESC],
            ],
            'parents_number' => [
                'asc' => [ 'parents_number' => SORT_ASC],
                'desc' => ['parents_number' => SORT_DESC],
            ],
            'parents_email' => [
                'asc' => [ 'parents_email' => SORT_ASC],
                'desc' => ['parents_email' => SORT_DESC],
            ],
            
             'birth' => [
                'asc' => [ 'birth' => SORT_ASC],
                'desc' => ['birth' => SORT_DESC],
            ],
            
            'userFullName' => [
                'asc' => [ 'users.surname' => SORT_ASC, 'users.name' => SORT_ASC, 'users.patronymic' => SORT_ASC],
                'desc' => ['users.surname' => SORT_DESC, 'users.name' => SORT_DESC, 'users.patronymic' => SORT_DESC],
            ],
            'userName' => [
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
            'birth' => $this->birth,
        ]);

        $query->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'parents_name', $this->parents_name])
            ->andFilterWhere(['like', 'parents_number', $this->parents_number])
            ->andFilterWhere(['like', 'parents_email', $this->parents_email]);
        
        $query->joinWith(['user' => function ($q) {
        $q->where('users.surname LIKE "%' . $this->userFullName . '%" ' .
        'OR users.name LIKE "%' . $this->userFullName . '%"' .
        'OR users.patronymic LIKE "%' . $this->userFullName . '%"'        
    )->andWhere('users.username LIKE "%' . $this->userName . '%" ')->andWhere('users.user_role = 5');
    }]);

        return $dataProvider;
    }
}
