<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Teachers;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$query = Teachers::find()->where('id > 0');
 $dataProvider = new ActiveDataProvider([
     'query' => $query
 ]);
 
 echo GridView::widget([
     
        'dataProvider' => $dataProvider,
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
  



