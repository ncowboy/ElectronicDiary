<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
rmrevin\yii\fontawesome\AssetBundle::register($this);
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ученики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">
    <h1><?=Html::encode($this->title)?></h1>
      <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                 [
                    'attribute' =>'userFullName',
                    'value' => function ($model) {
                    return Html::a(Html::encode($model->userFullName), Url::to([
                      '/teacher/students/view', 'id' => $model->id
                        ])
                      );
                    },
                      'format' => 'raw',
                    ],
                'userName',
                'phone_number',
                'parents_name',
                'parents_number',
                'parents_email:email',
                'birth:date',
            ],
        ]);
 
         ?>
     </div>     
</div>
