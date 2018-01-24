<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subjects */

$this->title = 'Редактирование предмета: ' . $model->alias;
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-update">

    <h1><?= Html::encode($this->title) ?></h1>
      <div class="col-md-6 col-md-offset-3"> 
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
      </div>    

</div>
