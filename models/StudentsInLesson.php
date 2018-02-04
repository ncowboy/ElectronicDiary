<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students_in_lesson".
 *
 * @property integer $lesson_id
 * @property integer $student_id
 * @property integer $attendance
 * @property integer $mark_work_at_lesson
 * @property integer $mark_homework
 * @property integer $mark_dictation
 *  @property integer $comment
 *
 * @property Lessons $lesson
 * @property Students $student
 */
class StudentsInLesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students_in_lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lesson_id', 'student_id'], 'required'],
            [['lesson_id', 'student_id', 'mark_work_at_lesson', 'mark_homework', 'mark_dictation'], 'integer'],
            [['student_id'], 'unique', 'targetAttribute' => ['student_id', 'lesson_id']],
            [['lesson_id'], 'unique', 'targetAttribute' => ['lesson_id', 'student_id']],
            [['attendance'], 'boolean'],
            [['comment'], 'string', 'max' => 1024],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::className(), 'targetAttribute' => ['lesson_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lesson_id' => 'Lesson ID',
            'student_id' => 'Student ID',
            'userfullName' => 'ФИО',
            'attendance' => 'Посещаемость',
            'mark_work_at_lesson' => 'Работа на уроке',
            'mark_homework' => 'Домашнее задание',
            'mark_dictation' => 'Диктант',
            'comment' => 'Комменатрий'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lessons::className(), ['id' => 'lesson_id']);
    }
    
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }
    
    public function getUserFullName()
    {
        return $this->student->userFullName;
    }
    
    public function getGroupCode()
    {
        return $this->lesson->group->groupCode;
    }
}
