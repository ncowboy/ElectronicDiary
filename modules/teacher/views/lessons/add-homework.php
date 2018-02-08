<?php
use yii\helpers\Html;

use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Lessons */

$this->title = 'Домашнее задание к уроку: ' . date('d/m/Y в H:i', strtotime($model->datetime));
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['/teacher/lessons']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-upload-homework">
  <div class="col-md-6 col-md-offset-3">  
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin();?>
    <?= $form->field($model, 'hw_text')->textarea(['maxlength' => true]); ?>
    <?= $form->field($model, 'hw_file')->fileInput(); ?>
    
  <div class="form-group">
        <?= Html::submitButton('Добавить', [
          'class' => 'btn btn-success'
          ]) ?>
       <?= Html::a('Отменить', ['/teacher/lessons'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>

