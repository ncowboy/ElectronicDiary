<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Teachers */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="teachers-form">
  <div class="col-md-6 col-md-offset-3">  

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'surname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'patronymic')->textInput(['maxlength' => true]) ?>
      
        <?= $form->field($teacher, 'specialization')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($teacher->isNewRecord ? 'Добавить ' : 'Сохранить', ['class' => $teacher->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отменить', ['/super/teachers'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>    

</div>
