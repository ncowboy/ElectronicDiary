<?php

use yii\db\Migration;

class m170829_182658_create_table_teachers extends Migration
{
    public function safeUp()
    {
        $this->createTable('teachers', [
            'id' => $this->primaryKey(5),
            'name' => $this->string(50)->notNull(),
            'specialization' =>$this->string(50),
            'group_id' => $this->integer(5),
        ]);
        
        $this->insert(teachers, [
            'name' => 'Гусынин Владислав Игоревич',
            'specialization' => 'Информатика',
            ]);
        
        $this->insert(teachers, [
            'name' => 'Петрова Анна Юрьевна',
            'specialization' => 'Математика',
            ]);
        
        $this->insert(teachers, [
            'name' => 'Акимов Борис Михайлович',
            'specialization' => 'Английский язык',
            ]);
    }

    public function safeDown()
    {
       $this->dropTable('teachers');
    }

}
