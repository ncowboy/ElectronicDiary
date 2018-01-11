<?php

use yii\db\Migration;


class m180111_122717_foreign_keys_groups extends Migration
{
    
    public function safeUp()
    {
        $this->addForeignKey('building_ibfk_1', 'groups', 'building_id', 'buildings', 'id');
        $this->addForeignKey('subjects_ibfk_1', 'groups', 'subject_id', 'subjects', 'id');
        $this->addForeignKey('grouptype_ibfk_1', 'groups', 'group_type_id', 'group_types', 'id');
    }

    
    public function safeDown()
    {
        echo "m180111_122717_foreign_keys cannot be reverted.\n";

        return false;
    }

}
