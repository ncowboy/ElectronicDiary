<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupTypes */

$this->title = 'Update Group Types: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Group Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
