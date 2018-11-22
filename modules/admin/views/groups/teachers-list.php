<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */
 
 echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'userFullName',
                'value' => function($model) use ($group_id) {
                 return Html::a(Html::encode($model->userFullName), Url::to(['teacher-set', 'group_id' => $group_id, 'teacher_id' => $model->id]));
                },
                'format' => 'raw',

            ],
        ],
    ]); 
  



