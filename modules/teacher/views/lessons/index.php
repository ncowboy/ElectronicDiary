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
$teacher_id = \app\models\Teachers::findOne(['user_id' => Yii::$app->user->identity->id]);
$groups = \app\models\Groups::findAll(['teacher_id' => $teacher_id]);
$groupItems = ArrayHelper::map($groups, 'id', 'groupCode');

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
                      'filter' => $groupItems,
                      'value' => function ($model) {
                        return Html::a(Html::encode($model->groupCode), Url::to([
                          '/teacher/groups/view', 'id' => $model->group_id
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
                     return !isset($model->hw_text) ? 
                          Html::a(FA::icon('tasks')->size(FA::SIZE_LARGE) . ' добавить',
                              Url::to(['/teacher/lessons/add-homework', 'id' => $model->id])):'';      
                   },
                     'format' => 'raw',   
                 ],           
                 'comment',
                ['class' => 'yii\grid\ActionColumn',
                        'template' => ' {view} {update} {results}',
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
