<?php

use yii\db\Migration;


class m180111_115516_test_ege extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('test_ege', [
           'id' => $this->primaryKey()->notNull(),
           'student_id' => $this->integer()->notNull(),
           'date' => $this->date()->notNull(),
           'mark' => $this->integer(4)->notNull() 
        ]);
    }

    
    public function safeDown()
    {
        echo "m180111_115516_test_ege cannot be reverted.\n";

        return false;
    }
}
