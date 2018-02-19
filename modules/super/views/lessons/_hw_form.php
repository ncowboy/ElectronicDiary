<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\FileHelper;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\models\Lessons */
$dir = 'uploads/hw/lesson' . $model->id;
if(is_dir($dir)) {
$files = FileHelper::findFiles($dir);
}

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
          'msgPlaceholder'=>'Загрузка файла(-ов)',
          'browseClass' => 'btn btn-primary btn-block',
          'browseIcon' => '<i class="fa fa-lg fa-folder-open"></i> ',
          'browseLabel' => 'Выбрать...',
          'allowedFileExtensions' => ['jpg','png','jpeg', 'gif', 'pdf', 'txt', 'doc', 'docx', 'xls', 'xlsx', 'ppt',
           'pptx', 'pps', 'ppsx' ],
    ],
        
    ])->label('');?> 
    <?= Html::submitButton($action !=='update' ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-success']); ?>
    <?= Html::a('Отменить', '/super/lessons', ['class' => 'btn btn-danger']);?>  
    <?php ActiveForm::end(); ?>
  </div>
</div>
<?php if($action == 'update'): ?>
<div class="col-md-4">
    <h3>Прикрепленные файлы</h3>
    <?php 
    if (isset($files)){
        foreach ($files as $value) {
            echo "<p>"
            . Html::a(basename($value), '/'. $value, [
                'target' => '_blank'
            ])
            . ' ' . Html::a(FA::icon('ban'), 
                           ['file-delete', 'src' => $value, 'lessonId' => $model->id],
                           [
                            'title' => 'Удалить', 
                            'style' =>'color: #d9534f;',   
                            'data' => [
                            'confirm' => 'Вы действительно хотите удалить файл?',
                            'method' => 'post',
                                 ],
                            ]) .
                    
                    "</p>";
        }
    }
    ?>
    
 </div>
<?php endif; ?>

