<?php

use yii\db\Migration;

class m170925_134010_fill_tables_for_groups extends Migration
{
    public function Up()
    {
         $this->insert('subjects', [
          'name' => 'math',
          'alias' => 'Математика'
        ]);
         
          $this->insert('subjects', [
          'name' => 'english',
          'alias' => 'Английский язык'
        ]);
          
           $this->insert('subjects', [
          'name' => 'informathics',
          'alias' => 'Информатика'
        ]);
           
            $this->insert('group_types', [
          'type_code' => 'e',
          'type_alias' => 'E',
          'description' => 'ЕГЭ',
        ]);
             $this->insert('group_types', [
          'type_code' => 'o',
          'type_alias' => 'О',
          'description' => 'ОГЭ',
        ]);
             
             $this->insert('buildings', [
          'name' => 'taganka',
          'alias' => 'Таганка',
          'region' => 'ЦАО',
          'metro'  => 'Таганская',
          'adress'  => 'ул-а Воронцовская, дом 35 «Б», кор-с 2',
        ]);
             
             $this->insert('buildings', [
          'name' => 'sokol-gora',
          'alias' => 'Соколиная гора',
          'region' => 'ВАО',
          'metro'  => 'Партизанская',
          'adress'  => 'Окружной проезд, дом 16',
        ]);
             
             $this->insert('buildings', [
          'name' => 'filpark',
          'alias' => 'Филевский парк',
          'region' => 'ЗАО',
          'metro'  => 'Кунцевская',
          'adress'  => ' ул-а Кастанаевская, дом 59, корпус 2',
        ]);
             
             
    }

    public function Down()
    {
        echo "m170925_134010_fill_tables_for_groups cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170925_134010_fill_tables_for_groups cannot be reverted.\n";

        return false;
    }
    */
}
