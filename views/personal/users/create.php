<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
$this->title = 'Добавить пользователя';
?>


<div class="row">
    <div class="sidebar col-md-2">
        <?=Nav::widget([
            'options' => ['class' => 'nav-stacked nav-fixed-left'],
            'items' => [
                ['label' => 'Пользователи', 'url' => ['personal/users/show'], 'class' => 'active'],
                ['label' => 'Учебные группы', 'url' => ['/personal']],
                ['label' => 'Преподаватели', 'url' => ['/personal']],
                ['label' => 'Ученики', 'url' => ['/personal']],
                ['label' => 'Отчеты', 'url' => ['/personal']],
               
          ],
            
        ]);
        ?>
    </div>
    <div class="content col-md-10">
      <div class="users-create">

     <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ;  
    ?>

    </div>     
   </div>  
</div>






