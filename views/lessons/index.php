<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LessonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lessons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lessons', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
             [
                 'attribute' => 'datetime',
                 'format' => ['dateTime', 'php:d/m/Y в H:i']
                        ],    
            'theme',
            'groupCode',
            'subjectAlias',

            ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete} {results}',
                    'header' => 'Действия',  
                     'buttons' => [
                        'update' => function ($url,$model) {
                            return Html::a(
                            FA::icon('pencil')->size(FA::SIZE_LARGE),     
                            $url,
                            ['title' => 'Редактировать']
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
                            'confirm' => 'Вы действительно хотите удалить филиал?',
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
