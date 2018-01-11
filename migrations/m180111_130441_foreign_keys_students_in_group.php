<?php

use yii\db\Migration;

class m180111_130441_foreign_keys_students_in_group extends Migration
{
    
    public function safeUp()
    {
        $this->addForeignKey('students_in_group_ibfk_1', 'students_in_group', 'group_id', 'groups', 'id', $delete = 'CASCADE');
        $this->addForeignKey('students_in_group_ibfk_2', 'students_in_group', 'student_id', 'students', 'id', $delete = 'CASCADE'); 
    }

  
    public function safeDown()
    {
        echo "m180111_130441_foreign_keys_students_in_group cannot be reverted.\n";

        return false;
    }

    
}
