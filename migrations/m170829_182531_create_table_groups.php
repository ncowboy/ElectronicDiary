<?php

use yii\db\Migration;

class m170829_182531_create_table_groups extends Migration
{
   public function Up()
    {
        $this->createTable('groups', [
            'id' => $this->primaryKey(5),
            'group_alias' => $this->string(50)->notNull(),
            'subject' => $this->string(30),
            'teacher_id' => $this->integer(5),
        ]);
        
        $this->insert(groups, [
            'group_alias' => '01.01-ЕГЭ-01',
            'subject' => 'Математика',
            'teacher_id' => 1,
        ]);
        
        $this->insert(groups, [
            'group_alias' => '01.02-ЕГЭ-02',
            'subject' => 'Русский язык',
            'teacher_id' => 2,
        ]);
        
        $this->insert(groups, [
            'group_alias' => '01.03-ЕГЭ-11',
            'subject' => 'Информатика',
            'teacher_id' => 3,
        ]);
    }

    public function Down()
    {
         $this->dropTable('groups');
    }

}
