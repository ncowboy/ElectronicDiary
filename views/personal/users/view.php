<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Пользователь: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['show']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр пользователя: ' . $model->username];
?>
        <div class="users-view">

            <h1 style="text-align: center;"><?= Html::encode($this->title) ?></h1>
          <div class="col-md-6 col-md-offset-3">   
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
  
