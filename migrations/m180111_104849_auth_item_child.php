<?php

use yii\db\Migration;


class m180111_104849_auth_item_child extends Migration
{
    
    public function safeUp()
    {
        $this->insert('auth_item_child', [
           'parent' => 'admin',
           'child' => 'groups_crud'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'super',
           'child' => 'groups_crud'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'teacher',
           'child' => 'groups_crud_self'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'admin',
           'child' => 'menu_catalog'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'super',
           'child' => 'menu_catalog'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'admin',
           'child' => 'menu_groups'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'super',
           'child' => 'menu_groups'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'teacher',
           'child' => 'menu_groups'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'admin',
           'child' => 'menu_lessons'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'super',
           'child' => 'menu_lessons'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'admin',
           'child' => 'menu_students'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'super',
           'child' => 'menu_students'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'admin',
           'child' => 'menu_teachers'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'super',
           'child' => 'menu_teachers'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'admin',
           'child' => 'menu_users'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'super',
           'child' => 'menu_users'
        ]);
         $this->insert('auth_item_child', [
           'parent' => 'admin',
           'child' => 'user_index'
        ]);
           $this->insert('auth_item_child', [
           'parent' => 'super',
           'child' => 'user_index'
        ]);
           $this->insert('auth_item_child', [
            'parent' => 'admin',
            'child' => 'users_admin_crud'
        ]);
         
         
    }

    
    public function safeDown()
    {
        echo "m180111_104849_auth_item_child cannot be reverted.\n";

        return false;
    }
}
