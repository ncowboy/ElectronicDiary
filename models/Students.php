<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $group_id
 * @property string $phone_number
 * @property string $parents_name
 * @property string $parents_number
 * @property string $birth
 *
 * @property Users $user
 * @property StudentsInGroup[] $studentsInGroups
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id'], 'integer'],
            [['phone_number', 'parents_number'], 'required'],
            [['birth'], 'safe'],
            [['phone_number', 'parents_number'], 'string', 'max' => 12],
            [['parents_name'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userFullName' => 'ФИО',
            'groupsAsString' => 'Группы',
            'userName' => 'Логин',
            'group_id' => 'Group ID',
            'phone_number' => 'Телефон',
            'parents_name' => 'ФИО Представителя',
            'parents_number' => 'Телефон представителя',
            'birth' => 'Дата рождения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

     public function getUserName() {
       return $this->user->username;
    }
    
    public function getUserFullName() {
       return $this->user->surname . ' ' . $this->user->name . ' ' . $this->user->patronymic;
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
 
    
    public function getGroups() {
        return $this->hasMany(Groups::className(), ['id' => 'group_id'])
                ->viaTable('students_in_group', ['student_id' => 'id']);
    }
    
     public function getGroupsAsString() {
        $string = ""; 
        foreach ($this->groups as $value) {
         $string = $string . $value->groupCode . "," . PHP_EOL;   
        }
        return $string;
    }
  
}