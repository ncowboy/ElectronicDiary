<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
rmrevin\yii\fontawesome\AssetBundle::register($this);
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['show']];
$roles = \app\models\UserRoles::find()->all();
$items= ArrayHelper::map($roles, 'role_alias', 'role_alias');

?>
      <div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Загрузить из файла', ['upload'], ['class' => 'btn btn-primary']) ?>
    </p>
      <div class="table-responsive">
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
                [
                  'attribute' =>  'userRoleName',
                  'filter' => $items, 

                ],
                'created_at:datetime',
                'updated_at:datetime',

                ['class' => 'yii\grid\ActionColumn',
                 'template' => '{view} {update} {delete} {changepass}',
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
                        'confirm' => 'Вы действительно хотите удалить пользователя?',
                        'method' => 'post',
                             ],
                        ]);
                   },
                    'changepass' => function ($url,$model) {
                        return Html::a(
                        FA::icon('key')->size(FA::SIZE_LARGE),     
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
     

