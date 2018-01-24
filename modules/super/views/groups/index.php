<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FA;
rmrevin\yii\fontawesome\AssetBundle::register($this);
use app\models\Buildings;
use app\models\Subjects;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группы';
$this->params['breadcrumbs'][] = $this->title;

$buildings = Buildings::find()->all();
$subjects = Subjects::find()->all();
$buildItems = ArrayHelper::map($buildings, 'alias', 'alias');
$SubjItems = ArrayHelper::map($subjects, 'alias', 'alias');
?>
<div class="groups-index">
  <h1><?= Html::encode($this->title) ?></h1>
  <p>
    <?= Html::a('Добавить группу', ['create'], ['class' => 'btn btn-success'])?>
  </p>
  <div class="table-responsive"> 
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
      'columns' => [
        [
          'class' => 'yii\grid\SerialColumn'
        ],
        [
          'attribute' => 'groupCode',
          'filter'=> $groupItems
        ], 
        [
          'attribute'=>'buildingName',
          'filter'=> $buildItems
        ],  
        [
         'attribute'=>'subjectName',
         'filter'=> $SubjItems
        ],

        [
          'class' => 'yii\grid\ActionColumn',
          'template' => '{view} {update} {delete} {group-content}',
          'header' => 'Действия',   
          'buttons' => [
            'view' => function ($url) {
                        return Html::a(
                        FA::icon('eye')->size(FA::SIZE_LARGE),     
                        $url,
                        ['title' => 'Просмотр']);
                    },
            'update' => function ($url) {
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
                          'confirm' => 'Вы действительно хотите удалить группу?',
                          'method' => 'post',
                             ],
                        ]);
                   },
            'group-content' => function ($url) {
                        return Html::a(
                        FA::icon('users')->size(FA::SIZE_LARGE),     
                        $url,
                        ['title' => 'Состав группы']
                                );
                    },
                ],   
              ],
            ],
        ]); ?>
  </div>     
</div>
