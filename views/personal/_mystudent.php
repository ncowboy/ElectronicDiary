<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<tr>
    <td><?= Html::a(Html::encode($model->userFullName), Url::to(['/students/view', 'id' => $model->id]))?></td>
  <td><?=$model->phone_number;?></td>
  <td><?=Html::mailto(Html::encode($model->user->email));?></td>
  <td><?=$model->groupsofTeacherAsString;?></td>
</tr>
