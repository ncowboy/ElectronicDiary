<?php

use yii\db\Migration;

class m180110_205724_auth_items extends Migration
{
   
    public function safeUp()
    {
        $this->insert('auth_item', [
            'name' => 'admin',
            'type' => 1,
        ]);
         $this->insert('auth_item', [
            'name' => 'curator',
            'type' => 1,
        ]);
          $this->insert('auth_item', [
            'name' => 'groups_crud',
            'type' => 2,
        ]);
           $this->insert('auth_item', [
            'name' => 'groups_crud_self',
            'type' => 2,
        ]);
            $this->insert('auth_item', [
            'name' => 'menu_catalog',
            'type' => 2,
        ]);
            $this->insert('auth_item', [
            'name' => 'menu_groups',
            'type' => 2,
        ]);
            $this->insert('auth_item', [
            'name' => 'menu_lessons',
            'type' => 2,
        ]);
            $this->insert('auth_item', [
            'name' => 'menu_students',
            'type' => 2,
        ]);
            $this->insert('auth_item', [
            'name' => 'menu_teachers',
            'type' => 2,
        ]);
            $this->insert('auth_item', [
            'name' => 'menu_users',
            'type' => 2,
        ]);
            $this->insert('auth_item', [
            'name' => 'student',
            'type' => 1,
        ]);
            $this->insert('auth_item', [
            'name' => 'super',
            'type' => 1,
        ]);
            $this->insert('auth_item', [
            'name' => 'teacher',
            'type' => 1,
        ]);
            $this->insert('auth_item', [
            'name' => 'user',
            'type' => 1,
        ]);
            $this->insert('auth_item', [
            'name' => 'user_index',
            'type' => 2,
        ]);
            $this->insert('auth_item', [
            'name' => 'users_admin_crud',
            'type' => 2,
        ]);
    }

    
    public function safeDown()
    {
        echo "m180110_205724_auth_items cannot be reverted.\n";

        return false;
    }

   
}
