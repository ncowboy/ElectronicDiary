<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Курсы по подготовке к ЕГЭ и ОГЭ в Москве - Вход';
$this->params['breadcrumbs'][] = ['label' => 'Вход на сайт'];
?>
 
<div class="site-login">
  <div class="col-md-4 col-md-offset-3">
    <h1>Вход на сайт</h1>

    <p>Для входа на сайт заполните следующие поля:</p>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
           
                <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
         
        </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>

