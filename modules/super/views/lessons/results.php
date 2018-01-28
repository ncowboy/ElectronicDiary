<?php
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

$this->title = 'Оценки за урок';
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['/super/lessons']];
$this->params['breadcrumbs'][] = ['label' => date('d/m/Y в H:i', strtotime($model->datetime)), 'url' => ['/super/lesons/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
  <div class="table-responsive">
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
            'emptyText' => 'В группе нет учеников',
            'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'], 
                'userfullName',
                [
                  'attribute' => 'attendance',
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
                'comment',
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

