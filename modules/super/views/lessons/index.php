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
    <p>
        <?= Html::a('Добавить урок', ['create'], ['class' => 'btn btn-success']); ?>
    </p>
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
                   'value' => function(\app\models\Lessons $model){
                     return !$model->hasHomework() ?
                          Html::a(' добавить', Url::to(['/super/lessons/add-homework', 'id' => $model->id])):
                         Html::a('просмотр', Url::to(['/super/lessons/homework', 'id' => $model->id])) . 
                             ' / ' . Html::a('редактировать', Url::to(['/super/lessons/homework-update', 'id' => $model->id])) ;
                   },
                     'format' => 'raw',   
                 ],  
                 'comment',
                ['class' => 'yii\grid\ActionColumn',
                        'template' => ' {view} {update} {delete} {results}',
                        'header' => 'Действия',  
                         'buttons' => [
                            'update' => function ($url,$model) {
                                return Html::a(
                                FA::icon('pencil')->size(FA::SIZE_LARGE),     
                                $url,
                                ['title' => 'Редактировать']
                                        );
                            },
                            'view' => function ($url,$model) {
                                return Html::a(
                                FA::icon('eye')->size(FA::SIZE_LARGE),     
                                $url,
                                ['title' => 'Просмотр']
                                        );
                            },
                            'delete' => function($url, $model){
                               return Html::a(
                               FA::icon('trash')->size(FA::SIZE_LARGE), 
                               ['delete', 'id' => $model->id],
                               [
                                'class' => '',
                                'title' => 'Удалить',   
                                'data' => [
                                'confirm' => 'Вы действительно хотите удалить урок?',
                                'method' => 'post',
                                     ],
                                ]);
                               
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
