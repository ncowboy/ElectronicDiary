<?php

use yii\db\Migration;

/**
 * Class m180123_112003_auth_item_no_role
 */
class m180123_112003_auth_item_no_role extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
      $this->insert('auth_item', [
        'name' => 'no role',
        'type' => 1
      ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180123_112003_auth_item_no_role cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180123_112003_auth_item_no_role cannot be reverted.\n";

        return false;
    }
    */
}
