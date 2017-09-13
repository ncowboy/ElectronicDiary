<?php

use yii\db\Migration;

class m170911_170459_create_table_user_roles extends Migration
{
    public function Up()
    {
            $this->createTable('user_roles', [
            'id_user_role' => $this->primaryKey(),
            'role_name' => $this->string(50)->notNull(),
            'role_alias' => $this->string(50)->notNull(),
        ]);
            
            $this->insert('user_roles', [
            'role_name' => 'Administrator',
            'role_alias'=> 'Администратор', 
        ]);
            $this->insert('user_roles', [
            'role_name' => 'Superviser',
            'role_alias'=> 'Супервайзер', 
        ]);
            $this->insert('user_roles', [
            'role_name' => 'Curator',
            'role_alias'=> 'Куратор', 
        ]);
            $this->insert('user_roles', [
            'role_name' => 'Teacher',
            'role_alias'=> 'Преподаватель', 
        ]);
            
            $this->insert('user_roles', [
            'role_name' => 'Student',
            'role_alias'=> 'Ученик', 
        ]);
    }

    public function Down()
    {
        echo "m170902_060538_create_table_user_roles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170902_060538_create_table_user_roles cannot be reverted.\n";

        return false;
    }
    */
}
