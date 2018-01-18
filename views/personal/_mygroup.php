<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<tr>
    <td><?=Html::a(Html::encode($model->groupCode), Url::to(['groups/group-content', 'id' => $model->id]));?></td>
  <td><?=$model->buildingName;?></td>
  <td><?=$model->subjectName;?></td>
</tr>
