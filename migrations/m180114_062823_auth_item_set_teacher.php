<?php

use yii\db\Migration;

/**
 * Class m180114_062823_auth_item_set_teacher
 */
class m180114_062823_auth_item_set_teacher extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('auth_item', [
            'name' => 'set_teacher',
            'type' => 2
        ]);
        
        $this->insert('auth_item_child', [
           'parent' => 'admin',
           'child' => 'set_teacher'
        ]);
        $this->insert('auth_item_child', [
           'parent' => 'super',
           'child' => 'set_teacher'
        ]);
                
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180114_062823_auth_item_set_teacher cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180114_062823_auth_item_set_teacher cannot be reverted.\n";

        return false;
    }
    */
}
