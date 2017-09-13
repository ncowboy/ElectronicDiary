<?php

namespace app\models\personal;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\personal\UserRoles;

/**
 * UserRolesSearch represents the model behind the search form about `app\models\personal\UserRoles`.
 */
class UserRolesSearch extends UserRoles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user_role'], 'integer'],
            [['role_name', 'role_alias'], 'safe'],
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
    public function search($params)
    {
        $query = UserRoles::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_user_role' => $this->id_user_role,
        ]);

        $query->andFilterWhere(['like', 'role_name', $this->role_name])
            ->andFilterWhere(['like', 'role_alias', $this->role_alias]);

        return $dataProvider;
    }
}
