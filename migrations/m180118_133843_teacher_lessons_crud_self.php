<?php

use yii\db\Migration;

/**
 * Class m180118_133843_teacher_lessons_crud_self
 */
class m180118_133843_teacher_lessons_crud_self extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
      $this->insert('auth_item', [
        'name' => 'lessons_crud_self',
        'type' => 2
      ]);
      
      $this->insert('auth_item_child', [
        'parent' => 'teacher',
        'child' => 'lessons_crud_self'
      ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180118_133843_teacher_lessons_crud_self cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180118_133843_teacher_lessons_crud_self cannot be reverted.\n";

        return false;
    }
    */
}
