<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
?>
<tr>
    <td>  
        <?php echo Html::a(Html::encode($model->userFullName), ['students/view', 'id' => $model->id]); ?>
    </td>
    <td>
       <?php echo Html::a(FA::icon('minus')->size(FA::SIZE_LARGE), 
               ['groups/delete-student', 'studentId' => $model->id, 'groupId' => $groupId],
               ['title' => 'Удалить из группы']
               
               ); ?> 
    </td>

</tr>
   



