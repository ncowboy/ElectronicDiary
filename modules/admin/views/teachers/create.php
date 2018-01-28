<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Teachers */

$this->title = 'Добавить преподавателя';
$this->params['breadcrumbs'][] = ['label' => 'Преподаватели', 'url' => ['/admin/teachers']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
        'teacher' => $teacher
    ]) ?>

</div>
