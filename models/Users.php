<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;
use app\models\Students;
use app\models\Teachers;

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
 * @property UserRoles $userRoles
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */ 
    public $new_password;
    public $new_confirm;
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
            [['user_role'], 'integer'],
            ['username', 'unique', 'targetAttribute' => 'username', 'targetClass' => Users::className(), 'message' => 'Имя пользователя уже существует в базе данных'],  
            [['username', 'name', 'surname', 'patronymic'], 'string', 'max' => 20],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z]\w{2,20}$/i', 'message' => 'Имя пользователя должно быть не короче 3 латинских символов или цифр и начинаться с буквы'],
            [['password'], 'match', 'pattern' => '/[0-9a-zA-Z!@#$%^&*]{6,}/i', 'message' => 'Пароль должен состоять не менее, чем из 6 латинских символов или цифр'],
            [['email'], 'email', 'message' => 'Некорректный формат email'],
            [['user_role'], 'default', 'value' => 0],
            [['user_role'], 'exist', 'skipOnError' => true, 'targetClass' => UserRoles::className(), 'targetAttribute' => ['user_role' => 'id_user_role']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Email',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'user_role' => 'Роль',
            'userRoleAlias' => 'Роль',
            'userFullName' => 'ФИО',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
            'userRoleAlias' => 'Роль',
        ];
    }
        public function behaviors()
    {
    return [
        [
            'class' => TimestampBehavior::className(),
            'value' => new Expression('NOW()'),
        ]            
    ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->hasOne(UserRoles::className(), ['id_user_role' => 'user_role']);
    }
    
    public function getUserRoleAlias(){
        return $this->userRoles->role_alias;
    }
    
    public function getUserRoleName(){
        return $this->userRoles->role_name;
    }
    
    public function getUserFullName(){
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }
 
    public function afterSave($insert, $changedAttributes) {
         $am = Yii::$app->authManager;
         $role = $am->getRole($this->userRoles->role_name);
         
        if ($insert) {
           $am->assign($role, $this->id);
           $user = Users::findOne(['id' => $this->id]);
           $user->password = \Yii::$app->security()->generatePasswordHash($this->password);
           $user->save();
                } else {
           $am->revokeAll($this->id);
           $am->assign($role, $this->id);
        }
        
        if (($changedAttributes['user_role']) && $this->user_role == 5) {
            $checkStudent = Students::findOne(['user_id' => $this->id]);
            if (!$checkStudent) {
            $student = new Students();
            $student->user_id = $this->id;
            $student->phone_number = '0';
            $student->parents_name = '0';
            $student->parents_number = '0';
            $student->parents_email = 'mail@mail.me';
            $student->birth = null;
            $student->save();
            }
        }
      
        if (($changedAttributes['user_role']) && $this->user_role == 4) {
            $checkTeacher = Teachers::findOne(['user_id' => $this->id]);
            if (!$checkTeacher) {
            $teacher = new Teachers();
            $teacher->user_id = $this->id;
            $teacher->specialization = NULL;
            $teacher->save();
            }
        }
    }
    
} 
