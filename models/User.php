<?php

namespace app\models;
use app\models\Users;
use yii\base\BaseObject;

class User extends BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $name;
    public $surname;
    public $patronymic;
    public $user_role;
    public $created_at;
    public $updated_at;
    public $authKey;
    public $accessToken;

    
    
    public static function findIdentity($id)
    {
        if($user = Users::findOne($id)){
            return new static($user->toArray());
       } 
            return null;
    
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
       if($user = Users::findOne(['username' => $username])){
            return new static($user->toArray());
       } 
       return null;
    
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password == \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
    
   
}
