<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = 'Добавить ученика';
$this->params['breadcrumbs'][] = ['label' => 'Ученики', 'url' => ['/super/students']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
        'student' => $student
        
    ]) ?>

</div>
