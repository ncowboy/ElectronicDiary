<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GroupTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отменить', ['/super/group-types'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
