<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\FileHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Lessons */

$files = FileHelper::findFiles('uploads/hw/lesson' . $model->id);

?>
<div class="lessons-update-homework">
  <div class="col-md-8 <?php if ($action=='add'):?> col-md-offset-2 <?php endif; ?>">  
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
    <?= $form->field($model, 'hw_text')->textarea([
        'rows' => '20'
    ])->label('')->widget(CKEditor::className())
; ?>
    <?= $form->field($model, 'hw_files[]')->fileInput(['multiple' => true])->widget(FileInput::className(), [
      'language' => 'ru',
      'options' => [
        'multiple' => true,
      ],
      'pluginOptions' => [
          'showUpload' => false,
          'showRemove' => false,
         // 'showPreview' => false,
          'browseClass' => 'btn btn-primary btn-block',
          'browseIcon' => '<i class="fa fa-lg fa-folder-open"></i> ',
          'browseLabel' => 'Добавить файлы',
          'allowedFileExtensions' => ['jpg','png','jpeg', 'gif', 'pdf', 'txt', 'doc', 'docx', 'xls', 'xlsx', 'ppt',
           'pptx', 'pps', 'ppsx' ],
    ],
        
    ])->label('');?> 
    <?= Html::submitButton($action !=='update' ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-success']); ?>
    <?= Html::a('Отменить', '/teacher/lessons', ['class' => 'btn btn-danger']);?>  
    <?php ActiveForm::end(); ?>
  </div>
</div>
<?php if($action == 'update'): ?>
<div class="col-md-4">
    <h3>Прикрепленные файлы</h3>
    <?php 
    if (isset($files)){
        foreach ($files as $value) {
            echo "<p> ". Html::a(basename($value), '/'. $value, [
                'target' => '_blank'
            ]) . "</p>";
        }
    }
    ?>
    
 </div>
<?php endif; ?>

