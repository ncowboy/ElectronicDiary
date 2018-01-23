<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Students */



$this->title = $model->userFullName;
$this->params['breadcrumbs'][] = ['label' => 'Ученики', 'url' => ['/students']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-view">

    <h1><?= Html::encode($this->title) ?></h1>
        <div class="col-md-6 col-md-offset-3">   
            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить ученика?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('К списку учеников', ['/students'], ['class'=>'btn btn-warning']) ?>
            </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'userName',
                        'phone_number',
                        'parents_name',
                        'parents_number',
                        'parents_email',
                        'birth',
                    ],
                ]);
                    ?>
        </div>    
</div>
