<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$query = Users::find()->where('user_role = 3');
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
                 return Html::a(Html::encode($model->userFullName), Url::to(['curator-set', 'group_id' => $group_id, 'curator_id' => $model->id]));
                },
                'format' => 'raw',

            ],
        ],
    ]); 
  



