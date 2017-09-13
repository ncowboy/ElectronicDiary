<?php

namespace app\models\personal;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $user_role
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property UserRoles $userRole
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required', 'message' => 'Поле не может быть пустым'],
            [['user_role', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z]\w{2,20}$/i', 'message' => 'Имя пользователя должно быть не короче 3 латинских символов или цифр и начинаться с буквы'],
            [['password'], 'match', 'pattern' => '/[0-9a-zA-Z!@#$%^&*]{6,}/i', 'message' => 'Пароль должен состоять не менее, чем из 6 латинских символов'],
            [['email'], 'email', 'message' => 'Некорректный формат email'],
            [['user_role'], 'exist', 'skipOnError' => true, 'targetClass' => UserRoles::className(), 'targetAttribute' => ['user_role' => 'id_user_role']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Iduser',
            'username' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Email',
            'user_role' => 'Роль',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
            'userRoleName' => 'Роль',
        ];
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->hasOne(UserRoles::className(), ['id_user_role' => 'user_role']);
    }
    
    public function getUserRoleName(){
        return $this->userRoles->role_alias;
    }
    
    
} 
