<?php

use yii\db\Migration;

class m170925_113609_create_table_users extends Migration
{
    public function Up()
    {
         $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            'password' => $this->string(50)->notNull(),
            'email' => $this->string(20)->notNull(),
            'surname' => $this->string(20)->notNull(),
            'name' => $this->string(20)->notNull(),
            'patronymic' => $this->string(20)->notNull(),  
            'user_role' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
            
        ]);
        
        $this->insert('users', [
            'username' => 'admin',
            'password'=> '21232f297a57a5a743894a0e4a801fc3',
            'user_role' => 1,
            'email' => 'admin@admin.ad',
            'surname' => 'Админов',
            'name' => 'Админ',
            'patronymic' => 'Админович'
        ]);
    }

    public function Down()
    {
        $this->dropTable('users');
    }


}
