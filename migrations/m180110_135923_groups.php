<?php

use yii\db\Migration;


class m180110_135923_groups extends Migration
{
  
    public function safeUp()
    {
        $this->createTable('groups', [
            'id' => $this->primaryKey()->notNull(),
            'building_id' => $this->integer(11)->notNull(),
            'subject_id' => $this->integer(11)->notNull(),
            'group_type_id' => $this->integer(11)->notNull(),
            'teacher_id' => $this->integer(11)->null(),
        ]);
        
        $this->insert('groups', [
           'id' => 3,
           'building_id' => 2,
           'subject_id' => 2,
           'group_type_id' => 2,
           'teacher_id' => 1,
        ]);
        
         $this->insert('groups', [
           'id' => 5,  
           'building_id' => 2,
           'subject_id' => 1,
           'group_type_id' => 1,
           'teacher_id' => 1,
        ]);
         
          $this->insert('groups', [
           'id' => 7,
           'building_id' => 1,
           'subject_id' => 1,
           'group_type_id' => 1,
           'teacher_id' => 2,
        ]);
          
           $this->insert('groups', [
           'id' => 8,
           'building_id' => 1,
           'subject_id' => 1,
           'group_type_id' => 2,
        ]);
           
            $this->insert('groups', [
           'id' => 10,
           'building_id' => 3,
           'subject_id' => 1,
           'group_type_id' => 3,
           'teacher_id' => 1,
        ]);
    }

    public function safeDown()
    {
        echo "m180110_135923_groups cannot be reverted.\n";

        return false;
    }

}
