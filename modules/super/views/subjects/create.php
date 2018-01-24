<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Subjects */

$this->title = 'Добавить предмет';
$this->params['breadcrumbs'][] = ['label' => 'Предметы', 'url' => ['/subjects']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-6 col-md-offset-3"> 
      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
    </div>    

</div>
