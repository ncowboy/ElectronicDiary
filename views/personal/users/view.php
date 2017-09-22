<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Пользователь: ' . $model->username;
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
        <div class="users-view">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить пользователя?',
                        'method' => 'post',
                    ],
                ]) ?>
                 <?= Html::a('К списку пользователей', ['/personal/users/show'], ['class'=>'btn btn-warning']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'email:email',
                    'userRoleName',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>

        </div>
    </div>  
</div>