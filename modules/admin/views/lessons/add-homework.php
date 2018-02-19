<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lessons */

$this->title = 'Домашнее задание к уроку: ' . date('d/m/Y в H:i', strtotime($model->datetime));
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['/teacher/lessons']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="lessons-add-homework">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_hw_form', [
        'model' => $model,
        'action' => 'add'
    ]); ?>
</div>

