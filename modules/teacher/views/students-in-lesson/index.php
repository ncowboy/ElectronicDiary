<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$lesson = \app\models\Lessons::findOne(['id' => $lesson_id]);
$this->title = 'Оценки за урок';
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['/teacher/lessons']];
$this->params['breadcrumbs'][] = ['label' => date('d/m/Y в H:i', strtotime($lesson->datetime)), 'url' => ['/teacher/lessons/view', 'id' => $lesson->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="students-in-lesson-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('К списку уроков', ['/lessons'], ['class'=>'btn btn-warning']) ?>
    <?php
    
   echo GridView::widget([
    'id' => 'kv-grid-marks',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
    'containerOptions' => ['style' => 'overflow: auto'], 
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo
    'resizableColumns'=>false,
    // set your toolbar
    'toolbar' =>  [
        '{export}',
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true,
        'label' => 'Экспорт',
        'header' => '',
        'showConfirmAlert' => false,
    ],
    // parameters from the demo form
    
    'responsive' => false,
    'responsiveWrap' => false,
    'hover' => $hover,
    'showPageSummary' => $pageSummary,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => date('d/m/Y в H:i', strtotime($lesson->datetime)) . '. Группа: ' . $lesson->getGroupCode() . '. Предмет: ' . $lesson->getSubjectAlias() . '. Тема: ' . $lesson->theme,
       'footer' => FALSE,
    ],
       'persistResize' => false,
       'toggleDataOptions' => ['minCount' => 20],
       'exportConfig' => [
                'html' => GridView::HTML,
                'xls' =>  GridView::EXCEL,
                'txt' =>  GridView::TEXT,
              ],
      'itemLabelSingle' => 'Ученик',
      'itemLabelPlural' => 'Учеников',

      'columns' => [
          [ 'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
          ],
          [
            'attribute'=>'userfullName', 
            'vAlign'=>'middle',
            'hAlign'=>'left', 
            'width'=>'20%',
          ],
          [
            'class'=>'kartik\grid\BooleanColumn',
            'attribute'=>'attendance',
            'trueLabel' => 'Присутств.',
            'falseLabel' => 'Отсутств.',
            'contentOptions' => [
                 'class'=>'mark-cell-style'
             ],
            'vAlign'=>'middle', 
          ],
          [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'mark_work_at_lesson',
            'contentOptions' => [
                'class'=>'mark-cell-style'
            ],
            'hAlign'=>'center',
            'vAlign'=>'middle', 
            'editableOptions'=>[
                'format' => 'button',
                'valueIfNull' => 'б/о',
                'showAjaxErrors' => false, 
                'header'=>'Оценка', 
                'asPopover' => true,
                'preHeader' =>'<i class="glyphicon glyphicon-edit"></i>   ',
                'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data' => [
                    '1'=> 1, 
                    '2'=> 2,
                    '3'=> 3,
                    '4'=> 4,
                    '5'=> 5
                    ],
                     ],
            'pageSummary'=>true
          ],
          [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'mark_homework',
            'contentOptions' => [
                'class'=>'mark-cell-style'
            ],
            'hAlign'=>'center',
            'vAlign'=>'middle', 
            'editableOptions'=>[
                'format' => 'button',
                'valueIfNull' => 'б/о',
                'showAjaxErrors' => false, 
                'header'=>'Оценка', 
                'asPopover' => true,
                'preHeader' =>'<i class="glyphicon glyphicon-edit"></i>   ',
                'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data' => [
                    '1'=> 1, 
                    '2'=> 2,
                    '3'=> 3,
                    '4'=> 4,
                    '5'=> 5
                    ],
                     ],
            'pageSummary'=>true
          ],
          [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'mark_dictation',
            'contentOptions' => [
                'class'=>'mark-cell-style'
            ],
            'hAlign'=>'center',
            'vAlign'=>'middle', 
            'editableOptions'=>[
                'format' => 'button',
                'valueIfNull' => 'б/о',
                'showAjaxErrors' => false, 
                'header'=>'Оценка', 
                'asPopover' => true,
                'preHeader' =>'<i class="glyphicon glyphicon-edit"></i>   ',
                'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data' => [
                    '1'=> 1, 
                    '2'=> 2,
                    '3'=> 3,
                    '4'=> 4,
                    '5'=> 5
                    ],
                     ],
            'pageSummary'=>true
          ],
            [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'comment',
            'hAlign'=>'left', 
            'editableOptions'=>[
                'valueIfNull' => 'Нет комментария',
                'asPopover' => false,
                'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                'showAjaxErrors' => false, 
                'submitOnEnter' => false,
                'options' => [
                    'class'=>'form-control', 
                    'rows'=>5, 
                    'style'=>'width:300px', 
                    'placeholder'=>'Текст комментария...'
                ]
                     ],
            'pageSummary'=>true
          ],
   
    ],
    
]);
    ?>
</div>
