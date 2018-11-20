<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use app\assets\GroupContentAsset;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

GroupContentAsset::register($this);
$this->title = $model->groupCode;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['/admin/groups']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="group-content"> 
  <div class="panel panel-info col-md-4" >
    <div class="panel-heading">   
          Преподаватель
    </div>
      <div class="panel-body">  
        <span> <?php echo $model->teacherName; ?></span>
          <?php
            $model->teacher_id == 0 ? $label = 'Назначить' : $label = 'Изменить'; 
            
            Modal::begin([
                'header' => '<h3>Выберите преподавателя</h3>',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => false],
                'toggleButton' => [
                    'tag' => 'a',
                    'class' => 'dropdown-toggle',
                    'style' => 'cursor: pointer;',
                    'label' => $label,
                ]
            ]);
 Pjax::begin();
            echo $this->render('teachers-list', [
                'group_id' => $model->id,
                'searchModel' => $teachersSearchModel,
                'dataProvider' => $teachersDataProvider
            ]);
 Pjax::end();
            Modal::end();
             ?>
          
      </div>  
  </div>
  <div class="panel panel-info col-md-4 col-md-offset-1" >
      <div class="panel-heading">   
            Куратор
      </div>
        <div class="panel-body">  
          <span> <?php echo $model->curatorFullName; ?></span>
          <?php
            $model->curator_userid == 0 ? $label = 'Назначить' : $label = 'Изменить'; 
            
            Modal::begin([
                'header' => '<h3>Выберите куратора</h3>',
                'toggleButton' => [
                    'tag' => 'a',
                    'class' => 'dropdown-toggle',
                    'style' => 'cursor: pointer;',
                    'label' => $label,
                ]
            ]);
      Pjax::begin();
            echo $this->render('curators-list', [
                'group_id' => $model->id,
                'searchModel' => $curatorsSearchModel,
                'dataProvider' => $curatorsDataProvider
            ]);
      Pjax::end();
            Modal::end();
             ?>
        </div>  
  </div>  
  <div class="col-md-12">  
    <?php 
    //  $searchModel = new \app\models\StudentsInGroup;
     /*  $dataProvider = new \yii\data\ActiveDataProvider([
          'query' => $searchModel->find()->where(['group_id' => $model->id]),
          'pagination' => [
              'pageSize' => 10
          ]
       ]);*/
       echo GridView::widget([
            'id' => 'kv-grid-students',
            'dataProvider' => $studentsDataProvider,
            'krajeeDialogSettings' => [ 'useNative'=>true ],
            'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
            'filterModel' => $studentsSearchModel,
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
                 'attribute'=>'userFullName',
                 'vAlign'=>'middle',
                 'hAlign'=>'left',
                ], 
                'phone_number',
                'userEmail:email',
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
          Pjax::begin();
            echo $this->render('students-list', [
                'groupId' => $model->id
            ]);
          Pjax::end();
       ?>
      </div>
    </div>
  </div>
</div>


