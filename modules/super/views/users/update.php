<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Редактирование пользователя: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/users']];
$this->params['breadcrumbs'][] = ['label' => 'Редактирование пользователя: ' . $model->username];
?>
<?php 
$roles= \app\models\UserRoles::find()->all();
$items= ArrayHelper::map($roles, 'id_user_role', 'role_alias');
?>
<div class="users-update">
  <h1><?= Html::encode($this->title) ?></h1>
  <div class="col-md-6 col-md-offset-3">
    <?php $form = ActiveForm::begin(); ?>

      <?= $form->field($model, 'username')->textInput(['maxlength' => true])?>

      <?= $form->field($model, 'email')->textInput(['maxlength' => true])?>

      <?= $form->field($model, 'surname')->textInput(['maxlength' => true])?>

      <?= $form->field($model, 'name')->textInput(['maxlength' => true])?>

      <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true])?>

      <?= $form->field($model, 'user_role')->dropDownList($items, [
        'prompt' => 'Выберите роль пользователя',
             ])?>
      <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Отменить', ['/users'], ['class'=>'btn btn-danger']) ?>
      </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>
      
