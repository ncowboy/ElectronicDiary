<?php

use yii\db\Migration;

/**
 * Class m180131_154526_alter_table_groups_add_curator_userid
 */
class m180131_154526_alter_table_groups_add_curator_userid extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
      $this->addColumn('groups', 'curator_userid', 'tinyint(1)');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180131_154526_alter_table_groups_add_curator_userid cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180131_154526_alter_table_groups_add_curator_userid cannot be reverted.\n";

        return false;
    }
    */
}
