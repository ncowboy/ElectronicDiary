<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группы';
$this->params['breadcrumbs'][] = $this->title;

$buildings = app\models\Buildings::find()->all();
$subjects = app\models\Subjects::find()->all();

$buildItems = ArrayHelper::map($buildings, 'alias', 'alias');
$SubjItems = ArrayHelper::map($subjects, 'alias', 'alias');
?>
<div class="groups-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'groupCode',
             [
            'attribute'=>'buildingName',
            'filter'=> $buildItems
             ],  
            [
            'attribute'=>'subjectName',
            'filter'=> $SubjItems
             ], 
          

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
