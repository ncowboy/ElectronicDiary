<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use app\assets\GroupContentAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

GroupContentAsset::register($this);
$this->title = $model->groupCode;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['/teacher/groups']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-content"> 
  <div class="panel panel-info col-md-6" >
    <div class="panel-heading">   
          Преподаватель
    </div>
      <div class="panel-body">  
        <span> <?php echo $model->teacherName; ?></span>
          
      </div>  
  </div>
  <div class="col-md-12">  
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
            'emptyText' => 'В группе нет учеников',
            'toolbar' =>  [
                ['content' => 
                     Html::button('<i class="glyphicon glyphicon-plus"></i> Добавить', [
                       'type' => 'button', 
                       'title' => Yii::t('kvgrid', 'Добавить студентов'), 
                       'class' => 'btn btn-success', 
                       'data-toggle' => 'modal', 
                       'data-target' => '#myModal'])
                ],
                '{export}',
            ],
            'export' => [
                'fontAwesome' => true,
                'label' => 'Экспорт',
                'header' => '',
                'showConfirmAlert' => false,
            ],
            'responsive' => false,
            'responsiveWrap' => false,
            'hover' => $hover,
            'panel' => [
                'type' => GridView::TYPE_INFO,
                'heading' => 'Студенты группы: ' . $model->groupCode,
                'after' => Html::button('Удалить выбранные', [
                  'type' => 'button', 
                  'title' => Yii::t('kvgrid', 'Удалить'), 
                  'class' => 'btn-delete btn btn-danger'
                ]),
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
               'columns' => 
               [
                [ 
                 'class'=>'kartik\grid\SerialColumn',
                 'contentOptions'=>['class'=>'kartik-sheet-style'],
                ],
                [
                 'attribute'=>'studentFullName', 
                 'vAlign'=>'middle',
                 'hAlign'=>'left',
                ], 
                'studentPhone',
                'studentEmail:email',
                [
                 'class' => 'kartik\grid\CheckboxColumn',
                 'headerOptions' => ['class' => 'kartik-sheet-style'],
                ],        
               ],
       ]);
       ?>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
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


