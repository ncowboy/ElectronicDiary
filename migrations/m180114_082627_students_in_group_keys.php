<?php

use yii\db\Migration;

/**
 * Class m180114_082627_students_in_group_keys
 */
class m180114_082627_students_in_group_keys extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addPrimaryKey('students', 'students_in_group', ['student_id', 'group_id']);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180114_082627_students_in_group_keys cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180114_082627_students_in_group_keys cannot be reverted.\n";

        return false;
    }
    */
}
