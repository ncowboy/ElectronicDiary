<?php

use yii\db\Migration;


class m180111_110638_students_in_group extends Migration
{
   
    public function safeUp()
    {
        $this->createTable('students_in_group', [
           'group_id' => $this->integer(11)->notNull(),
           'student_id' => $this->integer(11)->notNull(),
        ]);
        
        $this->insert('students_in_group', [
           'group_id' => 3,
           'student_id' => 19
        ]);
        $this->insert('students_in_group', [
           'group_id' => 3,
           'student_id' => 21
        ]);
        $this->insert('students_in_group', [
           'group_id' => 5,
           'student_id' => 19
        ]);
        $this->insert('students_in_group', [
           'group_id' => 5,
           'student_id' => 21
        ]);
        $this->insert('students_in_group', [
           'group_id' => 7,
           'student_id' => 19
        ]);
        $this->insert('students_in_group', [
           'group_id' => 7,
           'student_id' => 21
        ]);
        $this->insert('students_in_group', [
           'group_id' => 10,
           'student_id' => 19
        ]);
        $this->insert('students_in_group', [
           'group_id' => 10,
           'student_id' => 21
        ]);
    }

  
    public function safeDown()
    {
        echo "m180111_110638_students_in_group cannot be reverted.\n";

        return false;
    }

}
