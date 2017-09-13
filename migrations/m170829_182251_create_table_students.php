<?php

use yii\db\Migration;

class m170829_182251_create_table_students extends Migration
{
    public function Up()
    {
        $this->createTable('students', [
            'id' => $this->primaryKey(5),
            'name' => $this->string(50)->notNull(),
            'group_id' => $this->integer(5),
            'email' => $this->string(50),
            'phone_number' => $this->string(12)->notNull(),
            'parents_number' => $this->string(12)->notNull(),
            'birth' => $this->date(),
        ]);
        
        $this->insert(students, [
            'name' => 'Полина Гагарина',
            'group_id' => 1,
            'email' => 'polina@gmail.com',
            'phone_number' =>'89765678990',
            'parents_number' =>'87686545656',
            'birth' =>'1998-10-09',
            ]);
        
        $this->insert(students, [
            'name' => 'Петрова Анна Николаевна',
            'group_id' => 2,
            'email' => 'petrova@mail.ru',
            'phone_number' =>'89165555555',
            'parents_number' =>'89167899098',
            'birth' =>'1999-09-23',
            ]);
        
        $this->insert(students, [
            'name' => 'Денисов Артем Валерьевич',
            'group_id' => 3,
            'email' => 'denisov@gmail.com',
            'phone_number' =>'89168907841',
            'parents_number' =>'89086784567',
            'birth' =>'2000-12-01',
            ]);
    }

     public function Down()
   {
         $this->dropTable('students');
    }

   
}
