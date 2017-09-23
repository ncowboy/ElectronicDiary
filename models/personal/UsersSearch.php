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
            [['username', 'password', 'email', 'surname', 'name', 'patronymic', 'userRoleName'], 'safe'],
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
        $query = Users::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
        'attributes' => [
            'userRoleName' => [
                'asc' => ['user_roles.role_alias' => SORT_ASC],
                'desc' => ['user_roles.role_alias' => SORT_DESC]
            ],
            'username' => [
                'asc' => ['username' => SORT_ASC],
                'desc' => ['username' => SORT_DESC]
            ],
            'email' => [
                'asc' => ['email' => SORT_ASC],
                'desc' => ['email' => SORT_DESC]
            ],
            'surname' => [
                'asc' => ['surname' => SORT_ASC],
                'desc' => ['surname' => SORT_DESC]
            ],
             'name' => [
                'asc' => ['name' => SORT_ASC],
                'desc' => ['name' => SORT_DESC]
            ],
             'patronymic' => [
                'asc' => ['patronymic' => SORT_ASC],
                'desc' => ['patronymic' => SORT_DESC]
            ],
             'created_at' => [
                'asc' => ['created_at' => SORT_ASC],
                'desc' => ['created_at' => SORT_DESC]
            ],
              'updated_at' => [
                'asc' => ['updated_at' => SORT_ASC],
                'desc' => ['updated_at' => SORT_DESC]
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
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'name', $this->surname])
            ->andFilterWhere(['like', 'patronymic', $this->surname]);
        
        $query->joinWith(['userRoles' => function ($q) {
        $q->where('user_roles.role_alias LIKE "%' . $this->userRoleName . '%"');
    }]);

        return $dataProvider;
    }
}
