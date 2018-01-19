<?php

use yii\helpers\Url;
use yii\helpers\Html;
$datetime = new DateTime($model->datetime);

?>

<tr>
  <td><?= Html::a(Html::encode($datetime->format('d/m/Y H:i')), Url::to(['/lessons/results', 'id' => $model->id]));?></td>
  <td><?=$model->groupCode;?></td>
  <td><?=$model->subjectAlias;?></td>
  <td><?=$model->theme;?></td>
</tr>
