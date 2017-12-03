<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Личный кабинет пользователя ' . $model->userFullName;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет'];
?>
        <div class="users-view">

            <h1><?= Html::encode($model->userFullName) ?></h1>
          <div class="col-md-6 col-md-offset-3">   

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    'email:email',
                    'userRoleAlias',
                ],
            ]) ?>
        </div>

    </div>
  


