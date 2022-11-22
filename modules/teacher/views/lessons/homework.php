<?php

use yii\helpers\Html;
use yii\helpers\FileHelper;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$this->title = 'Домашнее задание к уроку: ' . date('d/m/Y в H:i', strtotime($model->datetime));
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['/teacher/lessons']];
$this->params['breadcrumbs'][] = $this->title;

$dir = 'uploads/hw/lesson' . $model->id;
if (is_dir($dir)) {
    $files = FileHelper::findFiles($dir);
}
?>

<div class="lessons-homework">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-8">
        <?= Html::a('Редактировать', ['/teacher/lessons/homework-update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('К списку уроков', '/teacher/lessons', ['class' => 'btn btn-success']); ?>

        <p><?= Html::tag('span', $model->hw_text) ?></p>
    </div>
    <div class="col-md-4">
        <h3>Прикрепленные файлы</h3>
        <?php
        if (isset($files)) {
            foreach ($files as $value) {
                echo "<p> " . Html::a(basename($value), '/' . $value, [
                        'target' => '_blank'
                    ]) . "</p>";

            }
        }

        ?>


    </div>
</div>