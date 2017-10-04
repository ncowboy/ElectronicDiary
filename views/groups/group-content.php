<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = $model->groupCode;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-6 col-md-offset-3 group-content"> 
    <div class="panel panel-primary">
      <div class="panel-heading">
          Преподаватель
      </div>
         <div class="panel-body">  
             Какой-то препод
     </div>  
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading">
          Ученики <span class="badge"> <?php echo count($model->students)?> </span>
      </div>  
      <div class="panel-body">  
        <?php 
         $studentsDataProvider = new ArrayDataProvider([
         'allModels' => $model->students,
         ]);
    
        echo ListView::widget([
        'dataProvider' => $studentsDataProvider,
        'itemView' => '_studentlist',
        'summary' => '',
        'emptyText' => 'В группе нет ни одного студента'
        ]);
        ?>
     </div>     
    </div> 
    
    
    
</div>
