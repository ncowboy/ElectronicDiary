<?php

namespace app\models;

use Yii;
use app\models\StudentsInLesson;
use app\models\Lessons;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "students_in_group".
 *
 * @property integer $student_id
 * @property integer $group_id
 *
 * @property Groups $group
 * @property Students $student
 */
class StudentsInGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students_in_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'group_id'], 'required'],
            [['student_id', 'group_id'], 'integer'],
            [['student_id'], 'unique', 'targetAttribute' => ['student_id', 'group_id']],
            [['group_id'], 'unique', 'targetAttribute' => ['group_id', 'student_id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'group_id' => 'Group ID',
            'studentFullName' => 'ФИО',
            'studentPhone' => 'Телефон',
            'studentEmail' => 'Email'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }
    
    public function getGroupCode()
    {
        return $this->group->getGroupCode();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }
    
    public function getStudentFullName()
    {
        return $this->student->user->userFullName;
    }
    
    public function getStudentPhone()
    {
        return $this->student->phone_number;
    }
    
    public function getStudentEmail()
    {
        return $this->student->user->email;
    }
    
    public function getStudentGroupsList(){
        return $this->hasMany(Students::className(), ['student_id' => 'id'])
            ->viaTable('students_in_group', ['group_id' => 'id']);
    }
      //При добавлении ученика в группу добавляем его во все уроки группы
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $studentCreateDate = $this->student->user->created_at;
            $lessons = Lessons::find()->where(['group_id' => $this->group_id])
                ->andWhere("datetime > '$studentCreateDate'")->all();
            $lessonsArr = ArrayHelper::toArray($lessons, [
                'app\models\Lessons' => ['id']
            ]);
            $lessonsIds = [];
            foreach ($lessonsArr as $value) {
                array_push($lessonsIds, $value['id']);
            }
            if(isset($lessonsIds)){
                foreach ($lessonsIds as $value) {
                    $model = new StudentsInLesson();
                    $model->student_id = $this->student_id;
                    $model->lesson_id = $value;
                    $model->save();
                }
            }
        }   
    }
     //При удалении ученика из группы удаляем его изо всех уроков группы
    public function beforeDelete() {
        parent::beforeDelete();
        $lessons = Lessons::findAll(['group_id' => $this->group_id]);
        $lessonsArr = ArrayHelper::toArray($lessons, [
        'app\models\Lessons' => ['id']
        ]);
        $lessonsIds = [];
        foreach ($lessonsArr as $value) {
        array_push($lessonsIds, $value['id']);
        }
        if(isset($lessonsIds)){
            foreach ($lessonsIds as $value) {
            $model = StudentsInLesson::findOne(['student_id' => $this->student_id, 'lesson_id' => $value]);
            $model->delete();
                }
            }
            return TRUE;
        
        }
}


