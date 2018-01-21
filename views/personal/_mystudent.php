<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<tr>
  <td><?=$model->userFullName?></td>
  <td><?=$model->phone_number;?></td>
  <td><?=$model->user->email;?></td>
  <td><?=$model->groupsAsString;?></td>
</tr>
