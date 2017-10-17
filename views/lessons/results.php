<?php
use yii\widgets\ListView;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

$this->title = 'Оценки за урок';
$this->params['breadcrumbs'][] = $this->title;

?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'], 
            'userfullName',
            'attendance:boolean',
            'mark_work_at_lesson',
            'mark_homework',
            'mark_dictation',

            ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} ',
                    'header' => 'Действия',  
                     'buttons' => [
                        'update' => function ($url,$model) {
                            return Html::a(
                            FA::icon('pencil')->size(FA::SIZE_LARGE),     
                            $url,
                            ['title' => 'Редактировать']
                                    );
                        },     
              
                    ]],
        ],
    ]); ?>
    
