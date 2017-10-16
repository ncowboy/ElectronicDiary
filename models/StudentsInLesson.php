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
            [['lesson_id', 'student_id', 'attendance', 'mark_work_at_lesson', 'mark_homework', 'mark_dictation'], 'integer'],
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
            'attendance' => 'Attendance',
            'mark_work_at_lesson' => 'Mark Work At Lesson',
            'mark_homework' => 'Mark Homework',
            'mark_dictation' => 'Mark Dictation',
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
}
