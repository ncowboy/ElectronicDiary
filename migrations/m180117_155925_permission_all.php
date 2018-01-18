<?php

use yii\db\Migration;

/**
 * Class m180117_155925_permission_all
 */
class m180117_155925_permission_all extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
      $this->insert('auth_item', [
        'name' => 'all',
        'type' => 2
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'admin',
        'child' => 'all'
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'super',
        'child' => 'all'
      ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180117_155925_permission_all cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180117_155925_permission_all cannot be reverted.\n";

        return false;
    }
    */
}
