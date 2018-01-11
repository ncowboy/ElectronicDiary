<?php

use yii\db\Migration;

class m180111_131130_foreign_keys_test_ege extends Migration
{
    
    public function safeUp()
    {
      $this->addForeignKey('test_ege_ibfk_1', 'test_ege', 'student_id', 'students', 'id');
    }

    public function safeDown()
    {
        echo "m180111_131130_foreign_keys_test_ege cannot be reverted.\n";

        return false;
    }

}
