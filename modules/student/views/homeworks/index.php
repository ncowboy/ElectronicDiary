<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Домашние задания';
$this->params['breadcrumbs'][] = ['label' => 'Домашние задания'];
?>

<div class="my-homeworks">
     <h1><?= Html::encode($this->title) ?></h1>
 <br>
 <?= GridView::widget([
   'dataProvider' => $dataProvider,
   'pjax'=>false,
   'responsiveWrap' => false,
    'striped'=>true,
    'krajeeDialogSettings' => [ 'useNative'=>true ],
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
    'showPageSummary' => $pageSummary,
    'panel'=>[
      'type'=>'primary', 
      'heading'=> 'Мои домашние задания',
      //'footer' => false
      ],
   'toolbar' => false,
   'columns' => [
     [
       'class' => 'kartik\grid\SerialColumn'
     ],
     [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'enableRowClick' => true,
        'expandIcon' => '<i class="fa fa-plus-square-o" aria-hidden="true", style="color: #337ab7;"></i>',
        'collapseIcon' => '<i class="fa fa-minus-square-o" aria-hidden="true", style="color: #337ab7;"></i>',
        'expandTitle' => 'Развернуть',
        'collapseTitle' => 'Cвернуть',
        'expandAllTitle' => 'Развернуть все',
        'collapseAllTitle' => 'Свернуть все',
       
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('_hw_partial', ['model' => $model]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'], 
        'expandOneOnly' => true
    ],
     [
       'attribute' => 'datetime',
       'format' => ['dateTime', 'php:d/m/Y в H:i']
     ],
     'groupCode',
     'theme',
     'comment'
     
   ]
   
 ]);?>
</div>    


