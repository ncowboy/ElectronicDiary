<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lessons */

$this->title = 'Добавить урок';
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['/admin/lessons']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="lessons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
