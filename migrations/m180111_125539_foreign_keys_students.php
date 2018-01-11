<?php

use yii\db\Migration;


class m180111_125539_foreign_keys_students extends Migration
{
   
    public function safeUp()
    {
     $this->addForeignKey('students_ibfk_1', 'students', 'user_id', 'users', 'id', $delete = 'CASCADE', $update ='CASCADE');
    }

   
    public function safeDown()
    {
        echo "m180111_125539_foreign_keys_students cannot be reverted.\n";

        return false;
    }
}
