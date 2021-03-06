﻿<?php
use yii\helpers\Html;
use app\models\Users;
$model = Users::findOne(Yii::$app->user->id);
$this->title = 'Личный кабинет пользователя ' . $model->userFullName;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет'];

echo '<pre>';
print_r($_COOKIE);
echo '</pre>';

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

?>

<div class="users-view row">  
      <div class="users-view-menu col-md-3">
          <p class="users-view-header"><?= Html::encode($model->userFullName) ?></p>
          <ul class="users-view-menu">
              <li><?= Html::a('Профиль', ['/personal'])?></li>  
              <?= Yii::$app->user->identity->user_role == 4 ? Html::tag('li', Html::a('Мои группы', ['my-groups'])) : '';?>
              <?= Yii::$app->user->identity->user_role == 4 ? Html::tag('li', Html::a('Мои уроки', ['my-lessons'])) : '';?>
              <?= Yii::$app->user->identity->user_role == 4 ? Html::tag('li', Html::a('Мои студенты', ['my-students'])) : '';?>
            </ul>
      </div> 
      <div class="col-md-9">   
        <?= $content ?>  
      </div>
</div>

