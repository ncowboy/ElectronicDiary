<?php

use yii\db\Migration;

class m170925_140028_add_foreign_keys_for_groups_tables extends Migration
{
    public function Up()
    {
       $this->addForeignKey(building_ibfk_1, groups, building_id, buildings, id);
       $this->addForeignKey(subjects_ibfk_1, groups, subject_id, subjects, id);
       $this->addForeignKey(grouptype_ibfk_1, groups, group_type_id, group_types, id);
      
    }
    
    public function Down()
    {
        echo "m170925_140028_add_foreign_keys_for_groups_tables cannot be reverted.\n";

        return false;
    }

    
}
