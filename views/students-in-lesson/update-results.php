<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentsInLesson */
/* @var $form ActiveForm */
?>
<div class="lessons-update-results">

    <?php $form = ActiveForm::begin([
        'id' => 'someform',
       'action' => ['lessons/updateresults', 'lesson_id' => $model->lesson_id, 'student_id' => $model->student_id]
       
    ]); ?>

  
        <?= $form->field($model, 'attendance')->dropDownList(['1' => 'Присутств.', '0' => 'Отсутств.']) ?>
        <?= $form->field($model, 'mark_work_at_lesson') ?>
        <?= $form->field($model, 'mark_homework') ?>
        <?= $form->field($model, 'mark_dictation') ?>
        <?= $form->field($model, 'comment')->textArea(['maxlength' => true]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- lessons-update-results -->
