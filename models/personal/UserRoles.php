<?php

namespace app\models\personal;

use Yii;

/**
 * This is the model class for table "user_roles".
 *
 * @property integer $id_user_role
 * @property string $role_name
 * @property string $role_alias
 *
 * @property Users[] $users
 */
class UserRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_name', 'role_alias'], 'required'],
            [['role_name', 'role_alias'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user_role' => 'Id User Role',
            'role_name' => 'Role Name',
            'role_alias' => 'Role Alias',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['user_role' => 'id_user_role']);
    }
}
