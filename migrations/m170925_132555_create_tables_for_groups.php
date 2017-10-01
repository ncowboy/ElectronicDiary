<?php

use yii\db\Migration;

class m170925_132555_create_tables_for_groups extends Migration
{
    public function Up()
    {
        $this->createTable('groups', [
          'id' => $this->primaryKey(),
          'building_id' => $this->integer(11)->notNull(),
          'subject_id' => $this->integer(11)->notNull(),
          'group_type_id' => $this->integer(11)->notNull()
        ]);
        
        $this->createTable('buildings', [
          'id' => $this->primaryKey(),
          'name' => $this->string(50)->notNull(),
          'alias' => $this->string(50)->notNull(),
          'region' => $this->string(50)->notNull(),
          'metro'  => $this->string(50)->notNull(),
          'adress'  => $this->string(128)->notNull(),
        ]);
        
        $this->createTable('group_types', [
          'id' => $this->primaryKey(),
          'type_code' => $this->string(20)->notNull(),
          'type_alias' => $this->string(20)->notNull(),
          'description' => $this->string(50)->notNull(),
        ]);
        
        $this->createTable('subjects', [
          'id' => $this->primaryKey(),
          'name' => $this->string(50)->notNull(),
          'alias' => $this->string(50)->notNull()
        ]);
        
    }

    public function Down()
    {
        
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170925_132555_create_table_groups cannot be reverted.\n";

        return false;
    }
    */
}
