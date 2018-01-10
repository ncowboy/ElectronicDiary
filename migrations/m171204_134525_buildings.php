<?php

use yii\db\Migration;

class m171204_134525_buildings extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('buildings', [
            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(50)->notNull(),
            'alias' => $this->string(50)->notNull(),
            'region' => $this->string(50)->notNull() ,
            'metro' => $this->string(50)->notNull() ,
            'adress' => $this->string(128)->notNull()
        ]);
        
        $this->insert('buildings', [
           'name' => 'taganka',
           'alias' => 'Таганка',
           'region' => 'ЦАО',
           'metro' => 'Таганская',
           'adress' => 'ул-а Воронцовская, дом 35 «Б», кор-с 2',
        ]);
        $this->insert('buildings', [
           'name' => 'sokol-gora',
           'alias' => 'Соколиная гора',
           'region' => 'ВАО',
           'metro' => 'Партизанская',
           'adress' => 'Окружной проезд, дом 16',
        ]);
        
        $this->insert('buildings', [
           'name' => 'filpark',
           'alias' => 'Филевский парк',
           'region' => 'ЗАО',
           'metro' => 'Кунцевская',
           'adress' => 'ул-а Кастанаевская, дом 59, корпус 2',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171204_134525_buildings cannot be reverted.\n";

        return false;
    }

   
}
