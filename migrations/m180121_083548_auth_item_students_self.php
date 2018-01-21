<?php

use yii\db\Migration;

/**
 * Class m180121_083548_auth_item_students_self
 */
class m180121_083548_auth_item_students_self extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('auth_item', [
           'name' => 'students_self',
           'type' => 2
        ]);
        
        $this->insert('auth_item_child', [
           'parent' => 'teacher',
           'child' => 'students_self' 
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180121_083548_auth_item_students_self cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180121_083548_auth_item_students_self cannot be reverted.\n";

        return false;
    }
    */
}
