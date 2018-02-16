<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\FileHelper;
use yii\helpers\Html;

$dir = 'uploads/hw/lesson' . $model->id;
if(is_dir($dir)) {
$files = FileHelper::findFiles($dir);
}
?>

<div class="row">
  <div class="col-md-9">
       <h4>Задание</h4>
      <?=$model->hw_text; ?>
  </div>  
  <div class="col-md-3">
      <h4>Прикрепленные файлы</h4>
        <?php 
    if (isset($files)){
        foreach ($files as $value) {
            echo "<p>"
            . Html::a(basename($value), '/'. $value, [
                'target' => '_blank'
            ])
            . "</p>";
        }
    }
    ?>
  </div>  
</div>    

    

