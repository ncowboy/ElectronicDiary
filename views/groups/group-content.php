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
            'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
            'containerOptions' => ['style' => 'overflow: auto'], 
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'pjax' => true, // pjax is set to always true for this demo
            'resizableColumns'=>false,
            // set your toolbar
            'toolbar' =>  [
                ['content' => 
            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#myModal'])
        ],
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
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading' => 'Студенты группы: ' . $model->groupCode,
                'after' => Html::button('Удалить выбранные', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-danger']),
                'afterOptions' => [
                  'align' => 'right'  
                ],
                'footer' => false,
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
               [
                'class' => 'kartik\grid\CheckboxColumn',
                'headerOptions' => ['class' => 'kartik-sheet-style'],
],        
          ],
           
       ]);
    
    ?>
    
    </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php 
            echo $this->render('students-list', [
                'groupId' => $model->id
            ]);
       ?>
      </div>
    </div>
  </div>
</div>
    
    
    
</div>

