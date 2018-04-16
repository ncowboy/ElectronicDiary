<?php

use yii\db\Migration;

class m180111_120037_users extends Migration
{
    public function safeUp()
    {
        $this->createTable('users', [
           'id' => $this->primaryKey()->notNull(),
           'username' => $this->string(50)->notNull(),
           'password' => $this->string(128)->notNull(),
           'email' => $this->string(128)->notNull(),
           'surname' => $this->string(20)->notNull(),
           'name' => $this->string(20)->notNull(), 
           'patronymic' => $this->string(20)->notNull(),
           'user_role' => $this->integer(11)->null(), 
           'created_at' => $this->dateTime()->null(), 
           'updated_at' => $this->dateTime()->null(),
        ]);
        
        $this->insert('users', [
           'id' => 2,
           'username' => 'super',
           'password' => '2ed5d4a15b8e2e9cc22a941e4d32b2cf',
           'email' => 'super@super.su',
           'surname' => 'Супер',
           'name' => 'Супер',
           'patronymic' => 'Суперович',
           'user_role' => 2
        ]);
        $this->insert('users', [
           'id' => 3,
           'username' => 'curator',
           'password' => '6c59130367269a109416e834e17fa55a',
           'email' => 'curator@curator.cu',
           'surname' => 'Кураторов',
           'name' => 'Куратор',
           'patronymic' => 'Кураторович',
           'user_role' => 3
        ]);
        $this->insert('users', [
           'id' =>22,
           'username' => 'vladgus',
           'password' => '1b12491c473c1e74bd068e65c5842f17',
           'email' => 'gusynin.vlad@gmail.com',
           'surname' => 'Гусынин',
           'name' => 'Владислав',
           'patronymic' => 'Игоревич',
           'user_role' => 4
        ]);
        $this->insert('users', [
           'id' =>23,
           'username' => 'iborisov',
           'password' => 'd54d1702ad0f8326224b817c796763c9',
           'email' => 'latentpickuper@gmail.com',
           'surname' => 'Борисов',
           'name' => 'Игорь',
           'patronymic' => 'Владимирович',
           'user_role' => 4
        ]); 
        $this->insert('users', [
           'id' =>24,
           'username' => 'student2',
           'password' => '5a3ce88ba9858971291d11275138143c',
           'email' => 'polina@gmail.com',
           'surname' => 'Гагарина',
           'name' => 'Полина',
           'patronymic' => 'Сергеевна',
           'user_role' => 5
        ]);
        $this->insert('users', [
           'id' =>26,
           'username' => 'student3',
           'password' => '2f029a1250c44708d7865338918648af',
           'email' => 'hmel89@mail.ru',
           'surname' => 'Хмелева',
           'name' => 'Наталья',
           'patronymic' => 'Степановна',
           'user_role' => 5
        ]);
        $this->insert('users', [
           'id' =>29,
           'username' => 'admin',
           'password' => 'f6fdffe48c908deb0f4c3bd36c032e72',
           'email' => 'admin@admin.ad',
           'surname' => 'Админов',
           'name' => 'Админ',
           'patronymic' => 'Админович',
           'user_role' => 1
        ]);
    }

    public function safeDown()
    {
        echo "m180111_120037_users cannot be reverted.\n";

        return false;
    }
}
