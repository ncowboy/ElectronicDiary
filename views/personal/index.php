<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\Navbar;
use yii\widgets\Breadcrumbs;

?>
<div class="row">
  <div class="sidebar col-md-2" > 
   <?=Nav::widget([
            'options' => ['class' => 'nav-stacked nav-fixed-left'],
            'items' => [
                ['label' => 'Пользователи', 'url' => ['personal/users/show']],
                ['label' => 'Учебные группы', 'url' => ['/personal']],
                ['label' => 'Преподаватели', 'url' => ['/personal']],
                ['label' => 'Ученики', 'url' => ['/personal']],
                ['label' => 'Отчеты', 'url' => ['/personal']],
          ],
        ]); 

           
?>
      
      
   </div>
   <div class="content col-md-10">
       
   </div>    
</div>

