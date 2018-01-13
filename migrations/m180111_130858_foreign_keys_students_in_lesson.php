<?php

use yii\db\Migration;


class m180111_130858_foreign_keys_students_in_lesson extends Migration
{
    
    public function safeUp()
    {
     $this->addPrimaryKey('student', 'students_in_lesson', ['student_id', 'lesson_id']);
     $this->addForeignKey('students_in_lesson_ibfk_1', 'students_in_lesson', 'lesson_id', 'lessons', 'id', $delete = 'CASCADE', $update = 'CASCADE');
     $this->addForeignKey('students_in_lesson_ibfk_2', 'students_in_lesson', 'student_id', 'students', 'id', $delete = 'CASCADE', $update = 'CASCADE'); 
    }

    public function safeDown()
    {
        echo "m180111_130858_foreign_keys_students_in_lesson cannot be reverted.\n";

        return false;
    }

  
}
