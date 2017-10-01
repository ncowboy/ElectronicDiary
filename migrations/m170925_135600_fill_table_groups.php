<?php

use yii\db\Migration;

class m170925_135600_fill_table_groups extends Migration
{
    public function Up()
    {
        $this->insert('groups', [
          'building_id' => 1,
          'subject_id' => 2,
          'group_type_id' => 2
        ]);
        
         $this->insert('groups', [
          'building_id' => 3,
          'subject_id' => 2,
          'group_type_id' => 1
        ]);
         
          $this->insert('groups', [
          'building_id' => 2,
          'subject_id' => 3,
          'group_type_id' => 1
        ]);
    }

    public function Down()
    {
        echo "m170925_135600_fill_table_groups cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170925_135600_fill_table_groups cannot be reverted.\n";

        return false;
    }
    */
}
