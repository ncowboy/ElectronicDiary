<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

$this->title = 'Успеваемость ученика';
$this->params['breadcrumbs'][] = ['label' => 'Оценки'];
?>

<div class="my-marks">
 <h1><?= Html::encode($this->title) ?></h1>
 <br>
<?php
  $export = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'target' => '_self',
    'krajeeDialogSettings' => [ 'useNative'=>true ],
    'showConfirmAlert' => false,
    'showColumnSelector' => false,
    'filename' => 'marks',
    'dropdownOptions' => [
      'icon' => '<i class="fa fa-share-square-o"></i>',
      'label' => ' Экспорт',
      'class' => 'btn btn-default'
    ],
    'columns'=>[
      [
            'attribute' => 'marksGroupedString',
            'group'=>true,  
            'groupedRow'=>true,                    
            'groupOddCssClass'=>'kv-grouped-row',  
            'groupEvenCssClass'=>'kv-grouped-row', 
      ],
      'dateTime',
      'theme',
     [
       'attribute'=>'attendance',
       'content' => function($model){
        if ($model->attendance==1) {
          return 'Присутств.';
        }else{
          return 'Отсутств.';
        }
       }
      ], 
      [
       'attribute'=>'mark_work_at_lesson',
       'contentOptions' => [
                'class'=>'mark-cell-style'
            ]
      ], 
       [
       'attribute'=>'mark_homework',
       'contentOptions' => [
                'class'=>'mark-cell-style'
            ]
      ], 
       [
       'attribute'=>'mark_dictation',
       'contentOptions' => [
                'class'=>'mark-cell-style'
            ]
      ], 
      'comment'
      ]
    
  ]);
?>

 
 <?=GridView::widget([
    'dataProvider'=>$dataProvider,
    'showPageSummary'=>true,
    'pjax'=>true,
    'striped'=>false,
    'krajeeDialogSettings' => [ 'useNative'=>true ],
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => 'б/о'],
    'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
    'showPageSummary' => $pageSummary,
    'panel'=>[
      'type'=>'primary', 
      'heading'=> $user,
      'footer' => false
      ],
    'toolbar' =>  [
        $export
    ],
    // set export properties
  
    'columns'=>[
      [
            'attribute' => 'marksGroupedString',
            'group'=>true,  
            'groupedRow'=>true,                    
            'groupOddCssClass'=>'kv-grouped-row',  
            'groupEvenCssClass'=>'kv-grouped-row', 
      ],
      'dateTime',
      'theme',
     [
       'class'=>'kartik\grid\BooleanColumn',
       'attribute'=>'attendance',
       'trueLabel' => 'Присутств.',
       'falseLabel' => 'Отсутств.',
       'contentOptions' => [
                'class'=>'mark-cell-style'
            ]
      ], 
      [
       'attribute'=>'mark_work_at_lesson',
       'contentOptions' => [
                'class'=>'mark-cell-style'
            ]
      ], 
       [
       'attribute'=>'mark_homework',
       'contentOptions' => [
                'class'=>'mark-cell-style'
            ]
      ], 
       [
       'attribute'=>'mark_dictation',
       'contentOptions' => [
                'class'=>'mark-cell-style'
            ]
      ], 
      'comment'
      ]
 ]);?>
 
</div>




  



