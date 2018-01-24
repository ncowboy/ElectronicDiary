<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Lessons */

$this->title = date('d/m/Y в H:i', strtotime($model->datetime));
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['/lessons']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-view">
  <div class="col-md-6 col-md-offset-3">  
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить урок?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
             'attribute' => 'datetime',
             'format' => ['dateTime', 'php:d/m/Y в H:i']
            ],
            'theme',
            [
               'attribute' =>  'groupCode',
               'value' => function ($model) {
            return Html::a(Html::encode($model->groupCode), Url::to(['groups/view', 'id' => $model->group_id]));
        },
               'format' => 'raw',

                    ],
            'subjectAlias',
            'comment',
        ],
    ]) ?>
  </div>
</div>
