<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "lessons".
 *
 * @property integer $id
 * @property string $datetime
 * @property string $theme
 * @property integer $group_id
 * @property Groups $group
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

    public $hw_files;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datetime'], 'required'],
            [['group_id'], 'integer'],
            [['group_id'], 'required', 'message' => 'Выберите группу'],
            [['theme'], 'string', 'max' => 256],
            [['theme'], 'required', 'message' => 'Укажите тему урока'],
            [['comment'], 'string', 'max' => 1024],
            [['comment'], 'default', 'value' => NULL],
            [['hw_text'], 'string', 'max' => 3060],
            [['hw_text'], 'default', 'value' => NULL],
            [['hw_files'], 'file', 'maxFiles' => 10],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'datetime' => 'Дата и время',
            'theme' => 'Тема',
            'groupCode' => 'Код группы',
            'group_id' => 'Код группы',
            'subjectAlias' => 'Предмет',
            'comment' => 'Комментарий',
            'homework' => 'Домашнее задание'
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
        return $this->addNull($this->group->building_id) . "." . $this->addNull($this->group->subject_id) . "-" . $this->group->groupType->type_alias . "-" . $this->addNull($this->group->id);
    }

    public function addNull($int)
    {
        if ($int < 10)
            $int = '0' . $int;
        return $int;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectAlias()
    {
        return $this->group->subjectName;
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

    public function setStudentsInLessons($lessonId)
    {
        $lesson = $this->findOne($lessonId);
        $students = $lesson->group->students;

        if (isset($students)) {
            foreach ($students as $value) {
                $model = new StudentsInLesson();
                $model->student_id = $value['id'];
                $model->lesson_id = $lesson->id;
                $model->save();
            }
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        // Если изменилась группа, удаляем из урока учеников из старой группы

        if ($changedAttributes['group_id'] !== (int)$this->group_id) {

            $studentToDelete = Students::find()->select('id')->where([
                'id' => StudentsInGroup::find()->select('student_id')
                    ->where([
                        'group_id' => $changedAttributes['group_id']
                    ])
            ])->column();

            StudentsInLesson::deleteAll([
                'lesson_id' => $this->id,
                'student_id' => $studentToDelete
            ]);

        }
    }

    /**
     * Проверяет, есть ли для урока домашняя работа (текст или приложенный файл)
     * @return bool
     */
    public function hasHomework()
    {
        $dir = 'uploads/hw/lesson' . $this->id;
        if (is_dir($dir)) {
            $files = FileHelper::findFiles($dir);
        }
        return isset($files) || isset($this->hw_text);
    }

}
