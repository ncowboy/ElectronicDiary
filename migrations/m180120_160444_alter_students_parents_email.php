<?php

use yii\db\Migration;

/**
 * Class m180120_160444_alter_students_parents_email
 */
class m180120_160444_alter_students_parents_email extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn('students', 'parents_email', 'string(128)');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180120_160444_alter_students_parents_email cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180120_160444_alter_students_parents_email cannot be reverted.\n";

        return false;
    }
    */
}
