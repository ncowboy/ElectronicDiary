<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$lesson = \app\models\Lessons::findOne(['id' => $lesson_id]);
$this->title = 'Оценки за урок';
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['/lessons']];
$this->params['breadcrumbs'][] = ['label' => date('d/m/Y в H:i', strtotime($lesson->datetime)), 'url' => ['/lessons/view', 'id' => $lesson->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-in-lesson-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    
   echo GridView::widget([
    'id' => 'kv-grid-demo',
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
        'type' => GridView::TYPE_INFO,
        'heading' => date('d/m/Y в H:i', strtotime($lesson->datetime)) . '. Группа: ' . $lesson->getGroupCode() . '. Предмет: ' . $lesson->getSubjectAlias() . '. Тема: ' . $lesson->theme,
        'footer' => FALSE,
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 30],
    'exportConfig' => [
            'html' => GridView::HTML,
            'xls' =>  GridView::EXCEL,
            'txt' =>  GridView::TEXT,
            
            ],
    'itemLabelSingle' => 'Ученик',
    'itemLabelPlural' => 'Учеников',

      'columns' => [
                ['class' => 'yii\grid\SerialColumn'], 
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
        ],
         [
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'mark_work_at_lesson',
    'editableOptions'=>[
        'valueIfNull' => 'нет оценки',
        'showAjaxErrors' => false, 
        'header'=>'Оценка', 
        'asPopover' => true,
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
                'mark_homework',
                'mark_dictation',
                'comment',
            ],
    
]);
    ?>
</div>
