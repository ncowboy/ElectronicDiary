<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Teachers */
/* @var $form yii\widgets\ActiveForm */

$users = Users::find()->where(['user_role' => 4])->all();
$items = ArrayHelper::map($users, 'id', 'username');

?>

<div class="teachers-form">
  <div class="col-md-6 col-md-offset-3">  

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'specialization')->textInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'user_id')->dropDownList($items, [
            'prompt' => 'Выберите логин пользователя',
        ])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить ' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отменить', ['/teachers'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>    

</div>
