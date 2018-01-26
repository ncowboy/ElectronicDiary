<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Teachers */

$this->title = 'Редактирование преподавателя: ' . $model->userFullname;
$this->params['breadcrumbs'][] = ['label' => 'Преподаватели', 'url' => ['/admin/teachers']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="teachers-update">
   <div class="col-md-6 col-md-offset-3"> 
     <h1><?= Html::encode($this->title) ?></h1>

         <?php $form = ActiveForm::begin(); ?>

         <?= $form->field($model, 'specialization')->textInput(['maxlength' => true]) ?>
    
         <div class="form-group">
               <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
               <?= Html::a('Отменить', ['/admin/teachers'], ['class'=>'btn btn-danger']) ?>
         </div>
          <?php ActiveForm::end(); ?>     
   </div>  

</div>
