<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Buildings */

$this->title = 'Редатирование филиала: ' . $model->alias;
$this->params['breadcrumbs'][] = ['label' => 'Филиалы', 'url' => ['/buildings']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buildings-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-6 col-md-offset-3">  
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>    
</div>
