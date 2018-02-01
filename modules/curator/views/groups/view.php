<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = 'Группа: ' . $model->getGroupCode();
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['/curator/groups']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-view">
  <h1><?= Html::encode($this->title) ?></h1>
  <div class="col-md-6 col-md-offset-3">   
    <p>
      <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить группу?',
                    'method' => 'post',
                    ],
               ])?>
      <?= Html::a('К списку групп', ['/curator/groups'], ['class'=>'btn btn-warning']) ?>
    </p>
   <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
      'buildingName',
      'subjectName',
      'groupTypeName',
    ],
  ]) ?>
  </div>
</div>
