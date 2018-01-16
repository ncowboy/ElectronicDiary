<?php

use yii\db\Migration;


class m180111_130858_foreign_keys_students_in_lesson extends Migration
{
    
    public function safeUp()
    {
     $this->addPrimaryKey('student', 'students_in_lesson', ['student_id', 'lesson_id']);
    }

    public function safeDown()
    {
        echo "m180111_130858_foreign_keys_students_in_lesson cannot be reverted.\n";

        return false;
    }

  
}
