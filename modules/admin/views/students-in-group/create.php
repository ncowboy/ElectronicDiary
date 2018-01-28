<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentsInGroup */

$this->title = 'Create Students In Group';
$this->params['breadcrumbs'][] = ['label' => 'Students In Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-in-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
