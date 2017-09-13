<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\personal\UserRoles */

$this->title = 'Update User Roles: ' . $model->id_user_role;
$this->params['breadcrumbs'][] = ['label' => 'User Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_user_role, 'url' => ['view', 'id' => $model->id_user_role]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-roles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
