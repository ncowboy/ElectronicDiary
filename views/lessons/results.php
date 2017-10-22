<?php
use yii\widgets\ListView;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use app\models\StudentsInLesson;

$this->title = 'Оценки за урок';
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => date('d/m/Y в H:i', strtotime($model->datetime)), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;


?>
  <div class="table-responsive">
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
            'emptyText' => 'В группе нет студентов',
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
  </div>

