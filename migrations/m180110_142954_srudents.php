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
            'id' => 1,
            'user_id' => 4,
            'phone_number' => '+7 (903) 588-42-07',
            'parents_name' => 'Мария Ивановна Петрова',
            'parents_number' => '+7-111-11-11',
            'parents_email' => 'mail@mail.me',
            'birth' => '1983-12-07',
        ]);
        $this->insert('students', [
            'id' => 2,
            'user_id' => 5,
            'phone_number' => '+7(903) 155-15-20',
            'parents_name' => 'Денисова Анна Евгеньевна',
            'parents_number' => '+7(905)125-20-55',
            'parents_email' => '',
            'birth' => '1983-11-09',
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
            'id' => 20,
            'user_id' => 25,
            'phone_number' => '89034567890',
            'parents_name' => 'Папа',
            'parents_number' => '89045678929',
            'parents_email' => '',
            'birth' => '1997-10-16',
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
