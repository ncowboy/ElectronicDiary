<?php
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = 'Оценки ученика: ' . $user;
$this->params['breadcrumbs'][] = ['label' => 'Оценки'];
?>

<div class="my-marks">
 <h1><?= Html::encode($this->title) ?></h1>
 <br>
 <?=Html::button(Html::tag('span', '', ['class' => 'fa fa-table']) . ' Экспорт в excel', [
     'class' => 'btn btn-success']);?>
 

<?= ListView::widget([
  'dataProvider' => $dataProvider,
  'itemView' => '_group',
  'summary' => false
]);?>
 
</div>




  



