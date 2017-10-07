<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */
/* @var $form yii\widgets\ActiveForm */

$buildings = \app\models\Buildings::find()->all();
$subjects = \app\models\Subjects::find()->all();
$groupTypes = \app\models\GroupTypes::find()->all();


$itemsBuild= ArrayHelper::map($buildings, 'id', 'alias');
$itemsSubj= ArrayHelper::map($subjects, 'id', 'alias');
$itemsGroupTypes= ArrayHelper::map($groupTypes, 'id', 'description');
?>

<div class="groups-form">
  <div class="col-md-6 col-md-offset-3">  

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'building_id')->dropDownList($itemsBuild, [
            'prompt' => 'Выберите филиал',
        ])?>
      
      <?= $form->field($model, 'subject_id')->dropDownList($itemsSubj, [
            'prompt' => 'Выберите предмет',
        ])?> 
      
       <?= $form->field($model, 'group_type_id')->dropDownList($itemsGroupTypes, [
            'prompt' => 'Выберите тип группы',
        ])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
         <?= Html::a('Отменить', ['/groups'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>    

</div>
