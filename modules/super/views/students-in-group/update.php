<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentsInGroup */

$this->title = 'Update Students In Group: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Students In Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->group_id, 'url' => ['view', 'group_id' => $model->group_id, 'student_id' => $model->student_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="students-in-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
