<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupTypes */

$this->title = 'Create Group Types';
$this->params['breadcrumbs'][] = ['label' => 'Group Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
