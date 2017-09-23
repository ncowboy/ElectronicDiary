<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';

?>

<div class="row">
  <div class="sidebar col-md-2"> 
   <?=Nav::widget([
            'options' => ['class' => 'nav nav-pills nav-stacked'],
            'items' => [
                ['label' => 'Пользователи', 'url' => ['personal/users/show']],
                ['label' => 'Учебные группы', 'url' => ['/personal']],
                ['label' => 'Преподаватели', 'url' => ['/personal']],
                ['label' => 'Ученики', 'url' => ['/personal']],
                ['label' => 'Отчеты', 'url' => ['/personal']],
          ],
        ]); 

           
?>
      
      
   </div>
   <div class="content col-md-10">
      <div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Загрузить из файла', ['upload'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Показано с {begin} по {end} из {totalCount}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            'surname',
            'name',
            'patronymic',
            'userRoleName',
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view} {update} {delete} {changepass}',
             'header' => 'Действия',   
             'buttons' => [
                'view' => function ($url,$model) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-eye-open"></span>',     
                    $url,
                    ['title' => 'Просмотр']
                            );
                },
                'update' => function ($url,$model) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-pencil"></span>',     
                    $url,
                    ['title' => 'Редактировать']
                            );
                },
                'delete' => function($url, $model){
                    return Html::a(
                   '<span class="glyphicon glyphicon-trash"></span>', 
                   ['delete', 'id' => $model->id],
                   [
                    'class' => '',
                    'title' => 'Удалить',   
                    'data' => [
                    'confirm' => 'Вы действительно хотите удалить пользователя?',
                    'method' => 'post',
                         ],
                    ]);
               },
                'changepass' => function ($url,$model) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-user"></span>',     
                    $url,
                    ['title' => 'Сменить пароль']
                            );
                },
                       
                 
               
                
            ],   
          ],
        ],
        
    ]);
    
    
    ?>
    
</div>   
   </div>    
</div>

