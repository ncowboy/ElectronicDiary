<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

//$this->title = 'Update Students: ' . $student->id;
//$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $student->id, 'url' => ['view', 'id' => $students->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="students-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
         'user' => $user,
         'student' => $student
    ]) ?>

</div>
