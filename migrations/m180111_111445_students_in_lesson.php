<?php

use yii\db\Migration;


class m180111_111445_students_in_lesson extends Migration
{
   
    public function safeUp()
    {
        $this->createTable('students_in_lesson', [
           'lesson_id' => $this->integer(11)->notNull(),
           'student_id' => $this->integer(11)->notNull(), 
           'attendance' => $this->integer(1)->defaultValue('0'),
           'mark_work_at_lesson' => $this->integer(1)->null(),
           'mark_homework' => $this->integer(1)->null(),
           'mark_dictation' => $this->integer(1)->null(), 
           'comment' => $this->string(1028)->notNull()
        ]);
        
        $this->insert('students_in_lesson', [
           'lesson_id' => 7,
           'student_id' => 19,
           'comment' => '' 
        ]);
         $this->insert('students_in_lesson', [
           'lesson_id' => 7,
           'student_id' => 21,
           'comment' => '' 
        ]);
          $this->insert('students_in_lesson', [
           'lesson_id' => 15,
           'student_id' => 19,
           'comment' => '' 
        ]);
           $this->insert('students_in_lesson', [
           'lesson_id' => 15,
           'student_id' => 21,
           'comment' => '' 
        ]);
    }

    
    public function safeDown()
    {
        echo "m180111_111445_students_in_lesson cannot be reverted.\n";

        return false;
    }
}
