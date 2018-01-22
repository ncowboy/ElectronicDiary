<?php 
use yii\widgets\ListView;
$this->beginContent('@app/views/layouts/personal.php');


?>

<h4>Мои уроки</h4>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
          <td>Дата и время</td>
          <td>Код группы</td>
          <td>Предмет</td>
          <td>Тема</td>
        </tr>  
    </thead>    
    <?php
      echo ListView::widget([
          'dataProvider' => $dataProvider,
          'itemView' => '_mylesson',
          'summary' => '',
          'emptyText' => 'Список пуст'
      ]);?>
</table>    
<?php
$this->endContent();