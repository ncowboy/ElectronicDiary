<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentsInLessonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="students-in-lesson-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'lesson_id') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'attendance') ?>

    <?= $form->field($model, 'mark_work_at_lesson') ?>

    <?= $form->field($model, 'mark_homework') ?>

    <?php // echo $form->field($model, 'mark_dictation') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
