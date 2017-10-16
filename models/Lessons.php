<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lessons".
 *
 * @property integer $id
 * @property string $datetime
 * @property string $theme
 * @property integer $group_id
 * @property integer $subject_id
 *
 * @property Groups $group
 * @property Subjects $subject
 * @property StudentsInLesson[] $studentsInLessons
 * @property Students[] $students
 */
class Lessons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datetime'], 'safe'],
            [['group_id', 'subject_id'], 'integer'],
            [['subject_id'], 'required'],
            [['theme'], 'string', 'max' => 256],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime' => 'Datetime',
            'theme' => 'Theme',
            'group_id' => 'Group ID',
            'subject_id' => 'Subject ID',
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
    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentsInLessons()
    {
        return $this->hasMany(StudentsInLesson::className(), ['lesson_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['id' => 'student_id'])->viaTable('students_in_lesson', ['lesson_id' => 'id']);
    }
}
