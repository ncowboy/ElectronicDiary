<?php 
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\StudentsInLesson;
use app\models\Lessons;

$lessons = Lessons::findAll(['group_id' => $model->group_id]);
$lessonIds = [];   


      foreach ($lessons as $value) {
        array_push($lessonIds, $value['id']);
     }
$dataProvider = new ActiveDataProvider([
  'query' => StudentsInLesson::find()->where(['student_id' => $model->student_id])->having(['lesson_id' => $lessonIds])
]);
?>

<h4>Группа <?=$model->groupCode ?>; Предмет: <?=$model->group->subjectName?>; Преподаватель: <?=$model->group->teacherName?></h4>
<table class="table table-striped table-bordered table-responsive">
  <thead>
    <tr>
      <th>Дата и время</th>
      <th>Посещаемость</th>
      <th>работа на уроке</th> 
      <th>Домашнее задание</th> 
      <th>Диктант</th>
      <th>Комментарий</th> 
    </tr>
    </thead>
  <?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_marks',
    'summary' => false,
    'viewParams' => [
      'group_id' => $model->group_id
    ]
  ]);
  ?>
</table>

