<?php

use yii\db\Migration;

/**
 * Class m180122_134138_auth_item_child_curator
 */
class m180122_134138_auth_item_child_curator extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
      $this->insert('auth_item_child', [
        'parent' => 'curator',
        'child' => 'menu_students'
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'curator',
        'child' => 'menu_groups'
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'curator',
        'child' => 'menu_lessons'
      ]);
      
      $this->insert('auth_item', [
        'name' => 'view_all',
        'type' => 2
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'curator',
        'child' => 'view_all'
      ]);
      
      
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180122_134138_auth_item_child_curator cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180122_134138_auth_item_child_curator cannot be reverted.\n";

        return false;
    }
    */
}
