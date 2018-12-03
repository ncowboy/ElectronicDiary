<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LessonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Уроки';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>
      <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                 [
                     'attribute' => 'datetime',
                     'format' => ['dateTime', 'php:d/m/Y в H:i']
                 ],
                [
                      'attribute' =>  'groupCode',
                      'value' => function ($model) {
                        return Html::a(Html::encode($model->groupCode), Url::to([
                          'groups/view', 'id' => $model->group_id
                            ])
                         );
                        },
                      'format' => 'raw',
                    ],
                 'subjectAlias', 
                 'theme',
                 [
                   'attribute' => 'homework',
                   'value' => function($model){
                     return !isset($model->hw_text) ? '' :
                         Html::a('просмотр', Url::to(['/curator/lessons/homework', 'id' => $model->id])) ;
                   },
                     'format' => 'raw',   
                 ], 
                 'comment',
                ['class' => 'yii\grid\ActionColumn',
                        'template' => ' {view} {results}',
                        'header' => 'Действия',  
                         'buttons' => [
                            'view' => function ($url,$model) {
                                return Html::a(
                                FA::icon('eye')->size(FA::SIZE_LARGE),     
                                $url,
                                ['title' => 'Просмотр']
                                        );
                            },
                            'results' => function ($url,$model) {
                            return Html::a(
                            FA::icon('graduation-cap')->size(FA::SIZE_LARGE),     
                            $url,    
                            ['title' => 'Оценки']
                                    );
                        },
                        ]],
            ],
        ]); ?>
      </div>      
</div>
