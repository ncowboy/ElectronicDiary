<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = $model->groupCode;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$studentsDataProvider = new ArrayDataProvider([
'allModels' => $model->students,
]);
?>
<div class="col-md-6 col-md-offset-3 group-content"> 
    <div class="panel panel-info">
      <div class="panel-heading">   
          Преподаватель
      </div>
         <div class="panel-body">  
            <span> <?php echo $model->teacherName; ?></span>
                <?php $model->teacher_id == 0 ? $label = 'Назначить' : $label = 'Изменить'; 
             
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
    <div class="panel panel-info">
      <div class="panel-heading">
          <p class="col-xs-8"><span>Студенты</span>
          <span class="badge"> <?php echo count($model->students)?> </span></p>
            <?php 
             Modal::begin([
                'header' => '<h3>Выберите одного или несколько студентов</h3>',
                'toggleButton' => [
                    'tag' => 'a',
                    'class' => 'btn btn-primary btn-sm',
                    'style' => 'cursor: pointer;',
                    'label' => 'Добавить в группу',
                ]
            ]);
            
            echo $this->render('students-list', [
                'groupId' => $model->id
            ]);
            
             Modal::end();
             ?>
             
      </div>  
      <div class="panel-body">  

          <table class="table table-hover"> 
            <?php 
              echo ListView::widget([
                'dataProvider' => $studentsDataProvider,
                'itemView' => 'students-in-group',
                'viewParams' => [
                    'groupId' => $model->id
                ],
                'summary' => '',
                'emptyText' => 'В группе нет ни одного студента'
                
                ]); 
            ?>  
          </table>
       
       
     </div>     
    </div> 
    
    
    
</div>

