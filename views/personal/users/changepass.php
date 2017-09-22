<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Сменить пароль пользователя: ' . $model->username;
?>

<?php 
$roles= \app\models\personal\UserRoles::find()->all();
$items= ArrayHelper::map($roles, 'id_user_role', 'role_alias');
?>
<div class="row">
    <div class="sidebar col-md-2">
        <?=Nav::widget([
            'options' => ['class' => 'nav nav-pills nav-stacked'],
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
      <div class="users-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'password')->passwordInput([
           
        'maxlength' => true,
        'autofocus' => true,
        'value'=>''
        ])->label('Введите новый пароль') ?>
    
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Отменить', ['/personal/users/show'], ['class'=>'btn btn-danger']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    </div>
  </div>
</div>    
        
