<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Teachers */

$this->title = $model->userFullName;
$this->params['breadcrumbs'][] = ['label' => 'Преподаватели', 'url' => ['/teachers']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-view">

    <h1><?= Html::encode($this->title) ?></h1>
        <div class="col-md-6 col-md-offset-3"> 
            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить преподавателя?',
                        'method' => 'post',
                    ],
                ]) ?>
                 <?= Html::a('К списку преподавателей', ['/teachers'], ['class'=>'btn btn-warning']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'userFullName',
                    'specialization'
                ],
            ]) ?>
        </div>    
</div>
