<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\StudentsInLesson */

$this->title = $model->lesson_id;
$this->params['breadcrumbs'][] = ['label' => 'Students In Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-in-lesson-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php      Modal::begin([
           'header' => '<h3>Выставить оценки</h3>',
            'toggleButton' => [
                    'tag' => 'a',
                    'class' => 'dropdown-toggle',
                    'style' => 'cursor: pointer;',
                    'label' => 'изменить',
                ]
     ]) ;
    //echo $this->render('update-results', [
     //'lesson_id' => $lesson->id,
    // 'student_id' => $student->id     
    // ]);
    
     echo "<pre>";
    print_r( $_REQUEST);
     echo "</pre>";





     Modal::end();
             
             ?>
        <?= 
        Html::a('Update', ['update', 'lesson_id' => $model->lesson_id, 'student_id' => $model->student_id], ['class' => 'btn btn-primary']) 
        ?>
        
        
        
        
        <?= Html::a('Delete', ['delete', 'lesson_id' => $model->lesson_id, 'student_id' => $model->student_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'lesson_id',
            'student_id',
            'attendance',
            'mark_work_at_lesson',
            'mark_homework',
            'mark_dictation',
        ],
    ]) ?>

</div>
