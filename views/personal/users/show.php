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
            'options' => ['class' => 'nav-stacked nav-fixed-left'],
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
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Показано с {begin} по {end} из {totalCount}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            'userRoleName',
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    
    
    ?>
    
</div>   
   </div>    
</div>

