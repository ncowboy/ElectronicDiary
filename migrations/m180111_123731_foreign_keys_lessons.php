<?php

use yii\db\Migration;


class m180111_123731_foreign_keys_lessons extends Migration
{
    
    public function safeUp()
    {
        $this->addForeignKey('lessons_ibfk_1', 'lessons', 'group_id', 'groups', 'id', $delete='CASCADE', $update='CASCADE');
    }

    public function safeDown()
    {
        echo "m180111_123731_foreign_keys_lessons cannot be reverted.\n";

        return false;
    }
}
