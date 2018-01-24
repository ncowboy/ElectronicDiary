<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupTypes */

$this->title = 'Редактирование типа группы: ' . $model->type_alias;
$this->params['breadcrumbs'][] = ['label' => 'Типы групп', 'url' => ['/group-types']];
$this->params['breadcrumbs'][] = $model->type_alias;
?>
<div class="group-types-update">

    <h1><?= Html::encode($this->title) ?></h1>
      <div class="col-md-6 col-md-offset-3"> 
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
      </div>    

</div>
