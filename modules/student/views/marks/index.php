<?php
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = 'Оценки ученика: ' . $user;
$this->params['breadcrumbs'][] = ['label' => 'Оценки'];
?>

<div class="my-marks">
 <h1><?= Html::encode($this->title) ?></h1>

<?= ListView::widget([
  'dataProvider' => $dataProvider,
  'itemView' => '_group',
  'summary' => false
]);?>
</div>




  



