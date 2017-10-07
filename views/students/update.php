<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = 'Редактирование студента: ' . $model->getUserFullName();
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>
<div class="students-update">
  <div class="col-md-6 col-md-offset-3"> 
    <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(); ?>

          <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'parents_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'parents_number')->textInput(['maxlength' => true]) ?>
    
        <?= '<label class="control-label">Дата рождения</label>'; ?>
      
        <?= DatePicker::widget([
            'model' => $model,
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
               <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Отменить', ['/students'], ['class'=>'btn btn-danger']) ?>
           </div>

           <?php ActiveForm::end(); ?>
    </div>
</div>
