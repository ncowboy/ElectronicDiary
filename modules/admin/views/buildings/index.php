<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BuildingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Филиалы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buildings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить филиал', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'alias',
                'region',
                'metro',
                'adress',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
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

                    ]
                ],
            ],
        ]); ?>
      </div>     
</div>
