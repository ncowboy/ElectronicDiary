<?php

use yii\db\Migration;

/**
 * Class m180111_121706_user_roles
 */
class m180111_121706_user_roles extends Migration
{
   
    public function safeUp()
    {
        $this->createTable('user_roles', [
           'id_user_role' => $this->integer(11)->notNull(),
           'role_name' => $this->string(50)->notNull(),
           'role_alias' => $this->string(50)->notNull()
        ]);
        
        $this->insert('user_roles', [
           'id_user_role' => 0,
           'role_name' => 'no role',
           'role_alias' => 'Роль не задана'
        ]);
         $this->insert('user_roles', [
           'id_user_role' => 1,
           'role_name' => 'admin',
           'role_alias' => 'Администратор'
        ]);
          $this->insert('user_roles', [
           'id_user_role' => 2,
           'role_name' => 'super',
           'role_alias' => 'Супервайзер'
        ]);
           $this->insert('user_roles', [
           'id_user_role' => 3,
           'role_name' => 'curator',
           'role_alias' => 'Куратор'
        ]);
            $this->insert('user_roles', [
           'id_user_role' => 4,
           'role_name' => 'teacher',
           'role_alias' => 'Преподаватель'
        ]);
           $this->insert('user_roles', [
           'id_user_role' => 5,
           'role_name' => 'student',
           'role_alias' => 'Ученик'
        ]);
    }
 public function safeDown()
    {
        echo "m180111_121706_user_roles cannot be reverted.\n";

        return false;
    }
}
