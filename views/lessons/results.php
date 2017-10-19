<?php
use yii\widgets\ListView;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use app\models\StudentsInLesson;

$this->title = 'Оценки за урок';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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

            ['class' => 'yii\grid\ActionColumn',
                    'template' => '{updateresults} ',
                    'header' => 'Действия',  
                     'buttons' => [
                        'updateresults' => function ($url, $model) {
                            return Html::a(
                            FA::icon('pencil')->size(FA::SIZE_LARGE),     
                            $url,   
                            ['title' => 'Редактировать']
                                    
                                    );
                        },     
              
                    ]],
        ],
    ]); ?>
    
