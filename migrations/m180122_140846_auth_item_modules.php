<?php

use yii\db\Migration;

/**
 * Class m180122_140846_auth_item_modules
 */
class m180122_140846_auth_item_modules extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
      $this->insert('auth_item', [
        'name' => 'admin_module',
        'type' => 2
      ]);
      
      $this->insert('auth_item', [
        'name' => 'super_module',
        'type' => 2
      ]);
      
      $this->insert('auth_item', [
        'name' => 'curator_module',
        'type' => 2
      ]);
      
      $this->insert('auth_item', [
        'name' => 'teacher_module',
        'type' => 2
      ]);
      
      $this->insert('auth_item', [
        'name' => 'student_module',
        'type' => 2
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'admin',
        'child' => 'admin_module'
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'super',
        'child' => 'super_module'
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'curator',
        'child' => 'curator_module'
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'teacher',
        'child' => 'teacher_module'
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'student',
        'child' => 'student_module'
      ]);
      
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180122_140846_auth_item_modules cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180122_140846_auth_item_modules cannot be reverted.\n";

        return false;
    }
    */
}
