<?php 
use yii\widgets\ListView;
$this->beginContent('@app/views/layouts/personal.php');


?>

<h4>Мои Ученики</h4>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
          <td>ФИО</td>
          <td>Телефон</td>
          <td>E-mail</td>
          <td>Группы</td>
        </tr>  
    </thead>    
    <?php
      echo ListView::widget([
          'dataProvider' => $dataProvider,
          'itemView' => '_mystudent',
          'summary' => '',
          'emptyText' => 'Список пуст'
      ]);?>
</table>    
<?php
$this->endContent();