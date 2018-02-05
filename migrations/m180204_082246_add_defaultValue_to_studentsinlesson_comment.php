<?php

use yii\db\Migration;

/**
 * Class m180204_082246_add_defaultValue_to_studentsinlesson_comment
 */
class m180204_082246_add_defaultValue_to_studentsinlesson_comment extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn('students_in_lesson', 'comment', 'string(1028) default null');   
      
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180204_082246_add_defaultValue_to_studentsinlesson_comment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180204_082246_add_defaultValue_to_studentsinlesson_comment cannot be reverted.\n";

        return false;
    }
    */
}
