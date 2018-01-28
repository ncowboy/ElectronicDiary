<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupTypes */

$this->title = 'Добавить тип группы';
$this->params['breadcrumbs'][] = ['label' => 'Типы групп', 'url' => ['/super/group-types']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-types-create">

    <h1><?= Html::encode($this->title) ?></h1>
      <div class="col-md-6 col-md-offset-3"> 

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
      </div>    

</div>
