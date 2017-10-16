<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_ege".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $teacher_id
 * @property string $date
 * @property integer $mark
 *
 * @property Students $student
 * @property Teachers $teacher
 */
class TestEge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_ege';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'teacher_id', 'date', 'mark'], 'required'],
            [['student_id', 'teacher_id', 'mark'], 'integer'],
            [['date'], 'safe'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'teacher_id' => 'Teacher ID',
            'date' => 'Date',
            'mark' => 'Mark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teacher_id']);
    }
}
