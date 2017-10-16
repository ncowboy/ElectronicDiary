<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentsInLesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="students-in-lesson-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lesson_id')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'attendance')->textInput() ?>

    <?= $form->field($model, 'mark_work_at_lesson')->textInput() ?>

    <?= $form->field($model, 'mark_homework')->textInput() ?>

    <?= $form->field($model, 'mark_dictation')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
