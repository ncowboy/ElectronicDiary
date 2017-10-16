<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Buildings */

$this->title = 'Create Buildings';
$this->params['breadcrumbs'][] = ['label' => 'Buildings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buildings-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-6 col-md-offset-3"> 
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>    
</div>
