<?php

use yii\helpers\Html;

$this->title = 'Добавить пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/super/users']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="users-create">

     <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
  
</div>     
   







