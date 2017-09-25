<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Сменить пароль пользователя: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['show']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<?php 
$roles= \app\models\personal\UserRoles::find()->all();
$items= ArrayHelper::map($roles, 'id_user_role', 'role_alias');
?>
      <div class="users-update">
          <div class="col-md-6 col-md-offset-3">  

             <h1 style="text-align: center;"><?= Html::encode($this->title) ?></h1>

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
        
