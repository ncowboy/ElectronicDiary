<?php

use yii\helpers\Html;
echo Html::a(Html::encode($model->userFullName), ['students/view', 'id' => $model->id]);

?>


   



