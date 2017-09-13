<?php

use yii\db\Migration;

class m170911_172401_add_timestamps_to_users_table extends Migration
{
    public function Up()
    {
        $this->addColumn('users', 'created_at', $this->integer(11));
        $this->addColumn('users', 'updated_at', $this->integer(11));
    }

    public function Down()
    {
        echo "m170911_172401_add_timestamps_to_users_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170911_172401_add_timestamps_to_users_table cannot be reverted.\n";

        return false;
    }
    */
}
