<?php

use yii\db\Migration;

class m171125_152804_rbac_init extends Migration
{
    public function safeUp()
    {
        $am = \Yii::$app->authManager;
        $admin = $am->createRole('admin');
        $teacher = $am->createRole('teacher');
        
        $am->add($admin);
        $am->add($teacher);
        
        $opGroupCreate = $am->createPermission('group_create');
        $opGroupDelete = $am->createPermission('group_delete');
        $opGroupView = $am->createPermission('group_veiw');
        
        $am->add($opGroupCreate);
        $am->add($opGroupDelete);
        $am->add($opGroupView);
        
        $am->addChild($admin, $opGroupCreate);
        $am->addChild($admin, $opGroupDelete);
        $am->addChild($admin, $opGroupView);
        
        $am->addChild($teacher, $opGroupView);
        
        $am->assign($admin, 1);
        $am->assign($teacher, 4);

        
    }

    public function safeDown()
    {
        echo "m171125_152804_rbac_init cannot be reverted.\n";

        return false;
    }

}
