<?php

use yii\db\Migration;


class m180110_142954_srudents extends Migration
{    
    public function safeUp()
    {
        $this->createTable('students', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->null(),
            'phone_number' => $this->string(20)->null(),
            'parents_name' => $this->string(50)->null(),
            'parents_number' => $this->string(20)->null(),
            'parents_email' => $this->string(20)->notNull(),
            'birth' => $this->date()->null(),
        ]);
        
       
        $this->insert('students', [
            'id' => 19,
            'user_id' => 24,
            'phone_number' => '89765678990',
            'parents_name' => 'Мама',
            'parents_number' => '87686545656',
            'parents_email' => '',
            'birth' => '1998-10-09',
        ]);
          $this->insert('students', [
            'id' => 21,  
            'user_id' => 26,
            'phone_number' => '89076789098',
            'parents_name' => 'Мама',
            'parents_number' => '89165434567',
            'parents_email' => '',
            'birth' => '2000-08-25',
        ]);
    }

    public function safeDown()
    {
        echo "m180110_142954_srudents cannot be reverted.\n";

        return false;
    }

    
}
