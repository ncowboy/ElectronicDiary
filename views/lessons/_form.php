<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Lessons */
/* @var $form yii\widgets\ActiveForm */

$subjects = app\models\Subjects::find()->all();
$groups = \app\models\Groups::find()->all();
$subjItems = ArrayHelper::map($subjects, 'id', 'alias');
$groupItems = ArrayHelper::map($groups, 'id', 'groupCode');
?>

<div class="lessons-form">
  <div class="col-md-6 col-md-offset-3">  

    <?php $form = ActiveForm::begin(); ?>

    <?= '<label class="control-label">Дата и время</label>';  ?>
    <?= DateTimePicker::widget([
        'model' => $model,
            'attribute' => 'datetime',
            'options' => ['placeholder' => 'Выберите дату...'],
            'language' => 'ru',
            'type' => DateTimePicker::TYPE_INPUT,
            'pluginOptions' => [
                'autoclose' => true,
              
            ]
        ]) ?>

    <?= $form->field($model, 'theme')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_id')->dropDownList($groupItems, [
            'prompt' => 'Выберите группу',
        ]) ?>

    <?= $form->field($model, 'subject_id')->dropDownList($subjItems, [
            'prompt' => 'Выберите предмет',
        ])  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
