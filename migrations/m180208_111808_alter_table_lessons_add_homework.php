<?php

use yii\db\Migration;

/**
 * Class m180208_111808_alter_table_lessons_add_homework
 */
class m180208_111808_alter_table_lessons_add_homework extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('lessons', 'hw_text', 'varchar(3060) default null');
      $this->addColumn('lessons', 'hw_file', 'varchar(255) default null');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180208_111808_alter_table_lessons_add_homework cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180208_111808_alter_table_lessons_add_homework cannot be reverted.\n";

        return false;
    }
    */
}
