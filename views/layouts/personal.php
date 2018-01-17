<?php
use yii\helpers\Html;
use app\models\Users;
$model = Users::findOne(Yii::$app->user->id);
$this->title = 'Личный кабинет пользователя ' . $model->userFullName;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет'];
?>

<div class="users-view row">  
      <div class="col-md-4">
          <p><h4><?= Html::encode($model->userFullName) ?></h4></p>
          <ul class="nav">
              <li><?= Html::a('Профиль', ['/personal'])?></li>  
              <?php 
              if (Yii ::$app->user->identity->user_role == 4) {
                echo Html::tag('li', Html::a('Мои группы', ['groups']));
              }
              ?>
            </ul>
      </div> 
      <div class="col-md-8">   
        <?= $content ?>  
      </div>
</div>

