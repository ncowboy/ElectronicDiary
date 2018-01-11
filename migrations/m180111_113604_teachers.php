<?php

use yii\db\Migration;


class m180111_113604_teachers extends Migration
{
 
    public function safeUp()
    {
        $this->createTable('teachers', [
           'id' => $this->primaryKey()->notNull(),
           'user_id' => $this->integer(11)->notNull(),
           'specialization' => $this->string(50)->null(),
           'group_id' => $this->integer()->null()
        ]);
        
        $this->insert('teachers', [
           'id' => 1, 
           'user_id' => 22,
           'specialization' => 'Информатика' 
        ]);
        $this->insert('teachers', [
           'id' => 2,  
           'user_id' => 23,
           'specialization' => 'Программирование' 
        ]);
    }

   
   
    public function safeDown()
    {
        echo "m180111_113604_teachers cannot be reverted.\n";

        return false;
    }

   
}
