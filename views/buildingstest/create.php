<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Buildingstest */

$this->title = 'Create Buildingstest';
$this->params['breadcrumbs'][] = ['label' => 'Buildingstests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buildingstest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
