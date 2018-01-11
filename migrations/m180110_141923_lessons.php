<?php

use yii\db\Migration;


class m180110_141923_lessons extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('lessons', [
            'id' => $this->primaryKey()->notNull(),
            'datetime' => $this->dateTime()->null(),
            'theme' => $this->string(256)->null(),
            'group_id' => $this->integer(11)->null(),
            'comment' => $this->string(1028)->null()
        ]);
        
        $this->insert('lessons', [
            'id' => 5,
            'datetime' => '2018-01-19 14:50:00',
            'theme' => 'testтема',
            'group_id' => 7,
        ]);
        $this->insert('lessons', [
            'id' => 6,
            'datetime' => '2017-10-28 14:50:00',
            'theme' => 'Поэзия серебряного века',
            'group_id' => 5,
        ]);
        $this->insert('lessons', [
            'id' => 7,
            'datetime' => '2017-10-20 13:05:00',
            'theme' => 'testтема',
            'group_id' => 3,
        ]);
        $this->insert('lessons', [
            'id' => 15,
            'datetime' => '2017-10-24 20:00:00',
            'theme' => 'testтема11111',
            'group_id' => 10,
            'comment' => 'drthrhtrh'
        ]);
    }

  
    public function safeDown()
    {
        echo "m180110_141923_lessons cannot be reverted.\n";

        return false;
    }

}
