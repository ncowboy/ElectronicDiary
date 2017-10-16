<?php
use yii\widgets\ListView;


?>

    <table class="table table-hover"> 
            <?php 
              echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_result',
              //  'summary' => '',
               // 'emptyText' => 'В группе нет ни одного студента'
                
                ]); 
         
            ?>  
          </table>