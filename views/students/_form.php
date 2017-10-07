<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Users;
use kartik\date\DatePicker;




$roles = Users::find()->where(['user_role' => 5])->all();
$items = ArrayHelper::map($roles, 'id', 'username');
?>

<div class="students-form">
  <div class="col-md-6 col-md-offset-3">  

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'surname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'patronymic')->textInput(['maxlength' => true]) ?>

        <?= $form->field($student, 'phone_number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($student, 'parents_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($student, 'parents_number')->textInput(['maxlength' => true]) ?>
      
        <?= '<label class="control-label">Дата рождения</label>'; ?>
      
        <?= DatePicker::widget([
            'model' => $student,
            'attribute' => 'birth',
            'options' => [
                'placeholder' => 'Выберите дату ...',
                'class' => 'form-group'
                ],
            'language' => 'ru',
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
		'format' => 'yyyy-mm-dd',
		'todayHighlight' => true,
                 'autoclose'=>true,
	]
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton($student->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $student->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
  </div>   

</div>
