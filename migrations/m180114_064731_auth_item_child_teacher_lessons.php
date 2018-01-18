<?php

use yii\db\Migration;

/**
 * Class m180114_064731_auth_item_child_teacher_lessons
 */
class m180114_064731_auth_item_child_teacher_lessons extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('auth_item_child', [
            'parent' => 'teacher',
            'child' => 'menu_lessons'
        ]);
         $this->insert('auth_item_child', [
            'parent' => 'teacher',
            'child' => 'menu_students'
        ]);
         
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180114_064731_auth_item_child_teacher_lessons cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180114_064731_auth_item_child_teacher_lessons cannot be reverted.\n";

        return false;
    }
    */
}
