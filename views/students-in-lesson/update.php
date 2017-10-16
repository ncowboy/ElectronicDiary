<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentsInLesson */

$this->title = 'Update Students In Lesson: ' . $model->lesson_id;
$this->params['breadcrumbs'][] = ['label' => 'Students In Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lesson_id, 'url' => ['view', 'lesson_id' => $model->lesson_id, 'student_id' => $model->student_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="students-in-lesson-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
