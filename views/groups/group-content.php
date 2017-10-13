<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = $model->groupCode;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?>
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
<?php Pjax::end();
