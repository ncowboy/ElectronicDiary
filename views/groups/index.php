<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FA;
rmrevin\yii\fontawesome\AssetBundle::register($this);
use app\models\Buildings;
use app\models\Subjects;
use app\models\Groups;
use app\models\Teachers;


/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группы';
$this->params['breadcrumbs'][] = $this->title;

$buildings = Buildings::find()->all();
$subjects = Subjects::find()->all();

if(Yii::$app->user->can('groups_crud')) {
    $groups = Groups::find()->all();
}else if (Yii::$app->user->can('groups_crud_self')) {
    $teacher = Teachers::findOne(['user_id' => Yii::$app->user->id]);
    $groups = Groups::findAll(['teacher_id' => $teacher->id]);
}


$buildItems = ArrayHelper::map($buildings, 'alias', 'alias');
$SubjItems = ArrayHelper::map($subjects, 'alias', 'alias');
$groupItems = ArrayHelper::map($groups, 'id', 'groupCode');

?>
<div class="groups-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      <div class="table-responsive"> 
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => "Показано с <strong>{begin}</strong> по <strong>{end}</strong> из <strong>{totalCount}</strong>",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

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

               ['class' => 'yii\grid\ActionColumn',
                 'template' => '{view} {update} {delete} {group-content}',
                 'header' => 'Действия',   
                 'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                        FA::icon('eye')->size(FA::SIZE_LARGE),     
                        $url,
                        ['title' => 'Просмотр']
                                );
                    },
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
                        'confirm' => 'Вы действительно хотите удалить группу?',
                        'method' => 'post',
                             ],
                        ]);
                   },
                      'group-content' => function ($url,$model) {
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
