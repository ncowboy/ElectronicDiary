<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = 'Редактирование группы: ' . $model->getGroupCode();
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['/groups']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-update">
  <h1><?= Html::encode($this->title) ?></h1>
  <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
