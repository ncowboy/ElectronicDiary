<?php

use yii\db\Migration;

class m170911_170450_create_table_users extends Migration
{
    public function Up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            'password' => $this->string(50)->notNull(),
            'user_role' => $this->integer(),
            'email' => $this->string(20)->notNull(),
        ]);
        
        $this->insert('users', [
            'username' => 'admin',
            'password'=> '21232f297a57a5a743894a0e4a801fc3',
            'user_role' => 1,
            'email' => 'admin@admin.ad',
        ]);

    }

    public function Down()
    {
        echo "m170902_060523_create_table_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170902_060523_create_table_users cannot be reverted.\n";

        return false;
    }
    */
}
