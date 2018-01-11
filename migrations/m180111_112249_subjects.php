<?php

use yii\db\Migration;


class m180111_112249_subjects extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('subjects', [
           'id' => $this->primaryKey()->notNull(),
           'name' => $this->string(50)->notNull(),
           'alias' => $this->string(50)->notNull()
        ]);
        
        $this->insert('subjects', [
           'name' => 'math',
           'alias' => 'Математика' 
        ]);
        $this->insert('subjects', [
           'name' => 'english',
           'alias' => 'Английский язык' 
        ]);
        $this->insert('subjects', [
           'name' => 'informatics',
           'alias' => 'Информатика' 
        ]);
        $this->insert('subjects', [
           'name' => 'russian',
           'alias' => 'Русский язык' 
        ]);
        $this->insert('subjects', [
           'name' => 'social',
           'alias' => 'Обществознание' 
        ]);
        $this->insert('subjects', [
           'name' => 'chemistry',
           'alias' => 'Химия' 
        ]);
        $this->insert('subjects', [
           'name' => 'literature',
           'alias' => 'Литература' 
        ]);
        $this->insert('subjects', [
           'name' => 'biology',
           'alias' => 'Биология' 
        ]);
        $this->insert('subjects', [
           'name' => 'geography',
           'alias' => 'География' 
        ]);
        $this->insert('subjects', [
           'name' => 'physics',
           'alias' => 'Физика' 
        ]);
        $this->insert('subjects', [
           'name' => 'history',
           'alias' => 'История' 
        ]);
        $this->insert('subjects', [
           'name' => 'languages',
           'alias' => 'Иностранные языки' 
        ]);
        
    }

   
    public function safeDown()
    {
        echo "m180111_112249_subjects cannot be reverted.\n";

        return false;
    }

   
}
