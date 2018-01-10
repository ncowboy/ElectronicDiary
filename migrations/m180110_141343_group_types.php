<?php

use yii\db\Migration;


class m180110_141343_group_types extends Migration
{
   
    public function safeUp()
    {
        $this->createTable('group_types', [
            'id' => $this->primaryKey()->notNull(),
            'type_code' => $this->string(20)->notNull(),
            'type_alias' => $this->string(20)->notNull(),
            'description' => $this->string(50)->notNull()
        ]);
        
        $this->insert('group_types', [
            'type_code' => 'e',
            'type_alias' => 'Е',
            'description' => 'ЕГЭ'
        ]);
        
        $this->insert('group_types', [
            'type_code' => 'o',
            'type_alias' => 'О',
            'description' => 'ОГЭ'
        ]);
        
        $this->insert('group_types', [
            'type_code' => 'z',
            'type_alias' => 'И',
            'description' => 'Прочее'
        ]);
    }

    
    public function safeDown()
    {
        echo "m180110_141343_group_types cannot be reverted.\n";

        return false;
    }

   
}
