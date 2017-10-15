<?php

namespace app\models;

use Yii;

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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }
    
    public function getStudentGroupsList(){
        return $this->hasMany(Students::className(), ['student_id' => 'id'])
            ->viaTable('students_in_group', ['group_id' => 'id']);
    }
}
