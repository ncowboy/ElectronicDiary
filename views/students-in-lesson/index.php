<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentsInLessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$lesson = \app\models\Lessons::findOne(['id' => $lesson_id]);
$this->title = 'Оценки за урок';
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['/lessons']];
$this->params['breadcrumbs'][] = ['label' => date('d/m/Y в H:i', strtotime($lesson->datetime)), 'url' => ['/lessons/view', 'id' => $lesson->id]];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="students-in-lesson-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <?php     
    
   echo "<pre>";
     //
       echo "</pre>";
             ?>
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
            'emptyText' => 'В группе нет учеников',
            'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'], 
                'userfullName',
                [
                  'attribute' => 'attendance',
                  //'format' => 'boolean',
                  'value' => function ($model){
                  $res = null;
                  if ($model->attendance == 0)
                  { $res = "Отсутств.";}
                    else if ($model->attendance == 1) {$res= "Присутств.";}
                    return $res;
                  }
                ],
                'mark_work_at_lesson',
                'mark_homework',
                'mark_dictation',
                'comment',

               ['class' => 'yii\grid\ActionColumn',
                        'template' => '{update} ',
                        'header' => 'Действия',  
                         'buttons' => [
                            'update' => function ($url, $model) {
                                
                                return Html::a(
                                'редактировать',        
                                $url,       
                                ['title' => 'Редактировать',
                                 'class' => 'pencil',
                                 'target' => '_blank'   
                                 
                                    ]

                                        );
                            },     
                            
                        ]],
            ],
        ]);  ?>*/
    <?php
    
echo \kartik\grid\GridView::widget([
    //'moduleId' => 'gridviewKrajee', // change the module identifier to use the respective module's settings
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'pjax'=>true,
 //   'pjaxSettings'=>[
   //     'neverTimeout'=>true,
  //  ],
      'columns' => [
                ['class' => 'yii\grid\SerialColumn'], 
                'userfullName',
                [
                  'attribute' => 'attendance',
                  //'format' => 'boolean',
                  'value' => function ($model){
                  $res = null;
                  if ($model->attendance == 0)
                  { $res = "Отсутств.";}
                    else if ($model->attendance == 1) {$res= "Присутств.";}
                    return $res;
                  }
                ],
                [
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'mark_work_at_lesson', 
   // 'readonly'=>function($model, $key, $index, $widget) {
   //     return (!$model->status); // do not allow editing of inactive records
   // },
    'editableOptions'=>[
        'header'=>'Buy Amount', 
        'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
        'options'=>[
            'pluginOptions'=>['min'=>0, 'max'=>5000]
        ]
    ],
    'hAlign'=>'right', 
    'vAlign'=>'middle',
    'width'=>'7%',
    'format'=>['decimal', 2],
    'pageSummary'=>true
],
                'mark_homework',
                'mark_dictation',
                'comment',

               ['class' => 'yii\grid\ActionColumn',
                        'template' => '{update} ',
                        'header' => 'Действия',  
                         'buttons' => [
                            'update' => function ($url, $model) {
                                
                                return Html::a(
                                'редактировать',        
                                $url,       
                                ['title' => 'Редактировать',
                                 'class' => 'pencil',
                                 'target' => '_blank'   
                                 
                                    ]

                                        );
                            },     
                            
                        ]],
            ],
    // other widget settings
]);
    ?>
</div>
