<?php

namespace app\models\personal;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\personal\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\personal\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public $userRoleName;
    
    public function rules()
    {
        return [
            [['id', 'user_role', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password', 'email', 'userRoleName'], 'safe'],
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
    $attribute = "user_roles.$attribute";

    if ($partialMatch) {
        $query->andWhere(['like', $attribute, $value]);
    } else {
        $query->andWhere([$attribute => $value]);
    }
}
    public function search($params)
    {
        $query = Users::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
        'attributes' => [
            'userRoleName' => [
                'asc' => ['user_roles.role_alias' => SORT_ASC],
                'desc' => ['user_roles.role_alias' => SORT_DESC],
                'label' => 'Role name'
            ],
            'username' => [
                'asc' => ['username' => SORT_ASC],
                'desc' => ['username' => SORT_DESC],
                'label' => 'Username'
            ],
            'email' => [
                'asc' => ['email' => SORT_ASC],
                'desc' => ['email' => SORT_DESC],
                'label' => 'E-mail'
            ],
             'created_at' => [
                'asc' => ['created_at' => SORT_ASC],
                'desc' => ['created_at' => SORT_DESC],
                'label' => 'created_at'
            ],
              'updated_at' => [
                'asc' => ['updated_at' => SORT_ASC],
                'desc' => ['updated_at' => SORT_DESC],
                'label' => 'updated_at'
            ],
        ]
    ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
             $query->joinWith(['userRoles']);
            return $dataProvider;
        }
        $this->addCondition($query, 'user_role');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_role' => $this->user_role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email', $this->email]);
        
        $query->joinWith(['userRoles' => function ($q) {
        $q->where('user_roles.role_alias LIKE "%' . $this->userRoleName . '%"');
    }]);

        return $dataProvider;
    }
}
