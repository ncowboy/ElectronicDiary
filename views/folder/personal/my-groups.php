<?php 
use yii\widgets\ListView;
$this->beginContent('@app/views/layouts/personal.php');


?>

<h4>Мои группы</h4>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
          <td>Номер группы</td>
          <td>Здание</td>
          <td>Предмет</td>
        </tr>  
    </thead>    
    <?php
      echo ListView::widget([
          'dataProvider' => $dataProvider,
          'itemView' => '_mygroup',
          'summary' => '',
          'emptyText' => 'Список пуст'
      ]);?>
</table>    
<?php
$this->endContent();