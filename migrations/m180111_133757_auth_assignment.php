<?php

use yii\db\Migration;


class m180111_133757_auth_assignment extends Migration
{
    
    public function safeUp()
    {
        $this->insert('auth_assignment', [
           'item_name' => 'super',
           'user_id' => 2, 
        ]);
         $this->insert('auth_assignment', [
           'item_name' => 'curator',
           'user_id' => 3, 
        ]);
          $this->insert('auth_assignment', [
           'item_name' => 'teacher',
           'user_id' => 22, 
        ]);
           $this->insert('auth_assignment', [
           'item_name' => 'teacher',
           'user_id' => 23, 
        ]);
            $this->insert('auth_assignment', [
           'item_name' => 'student',
           'user_id' => 24, 
        ]);
             $this->insert('auth_assignment', [
           'item_name' => 'student',
           'user_id' => 26, 
        ]);
              $this->insert('auth_assignment', [
           'item_name' => 'admin',
           'user_id' => 29, 
        ]);
    }

    public function safeDown()
    {
        echo "m180111_133757_auth_assignment cannot be reverted.\n";

        return false;
    }

}
