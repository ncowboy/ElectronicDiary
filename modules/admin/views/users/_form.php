<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$roles= \app\models\UserRoles::find()->all();
$items= ArrayHelper::map($roles, 'id_user_role', 'role_alias');

?>
<div class="users-form">
    <div class="col-md-6 col-md-offset-3">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['maxlength' => true])?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'user_role')->dropDownList($items, [
            'prompt' => 'Выберите роль пользователя',
        ])?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('Отменить', ['/admin/users'], ['class'=>'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>    
</div>
