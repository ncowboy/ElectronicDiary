<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;
use rmrevin\yii\fontawesome\FA;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = $model->groupCode;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$studentsDataProvider = new ArrayDataProvider([
'allModels' => $model->students,
]);
?>
<div class="group-content"> 
    <div class="panel panel-info" >
      <div class="panel-heading">   
          Преподаватель
      </div>
         <div class="panel-body">  
            <span> <?php echo $model->teacherName; ?></span>
                <?php 
                if (Yii::$app->user->can('set_teacher')) {
                $model->teacher_id == 0 ? $label = 'Назначить' : $label = 'Изменить'; 
                }
             
            Modal::begin([
                'header' => '<h3>Выберите преподавателя</h3>',
                'toggleButton' => [
                    'tag' => 'a',
                    'class' => 'dropdown-toggle',
                    'style' => 'cursor: pointer;',
                    'label' => $label,
                ]
            ]);
 
            echo $this->render('teachers-list', [
                'group_id' => $model->id
            ]);

            Modal::end();
             ?>
          
         </div>  
    </div>
    
    <?php 
       $searchModel = new \app\models\StudentsInGroup;
       $dataProvider = new \yii\data\ActiveDataProvider([
          'query' => $searchModel->find()->where(['group_id' => $model->id]) 
       ]);
       echo GridView::widget([
           'id' => 'kv-grid-students',
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
                'heading' => 'Студенты группы: ' . $model->groupCode,
               'footer' => FALSE,
            ],
               'persistResize' => false,
               'toggleDataOptions' => ['minCount' => 20],
               'exportConfig' => [
                        'html' => GridView::HTML,
                        'xls' =>  GridView::EXCEL,
                        'txt' =>  GridView::TEXT,
                      ],
           'columns' => [
               [ 'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
          ],
              
              [
            'attribute'=>'studentFullName', 
            'vAlign'=>'middle',
            'hAlign'=>'left', 
           
          ],
           
          
          ],
           
       ]);
    
    ?>
    
    </div> 
    
    
    
</div>

