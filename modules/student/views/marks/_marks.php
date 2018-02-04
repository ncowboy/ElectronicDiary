<?php
use yii\helpers\Html;
?>
<tr> 
  <th><?=date('d/m/Y в H:i', strtotime($model->lesson->datetime));?></th>
  <th class="mark-cell-style"><?=$model->attendance==1 ? Html::tag('span', '', [
      'class' => 'glyphicon glyphicon-ok text-success']) : 
      Html::tag('span', '', [
      'class' => 'glyphicon glyphicon-remove text-danger']) 
      ;?></th>
  <th class="mark-cell-style"><?=$model->mark_work_at_lesson;?></th> 
  <th class="mark-cell-style"><?=$model->mark_homework;?></th> 
  <th class="mark-cell-style"><?=$model->mark_dictation;?></th>
  <th><?=$model->comment?></th> 
 
<tr>

