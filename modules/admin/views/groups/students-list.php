  <?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\StudentsInGroup;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */
$studentsInGroup = StudentsInGroup::findAll(['group_id' => $groupId]);
$arr = [];
if(isset($studentsInGroup)){
  foreach ($studentsInGroup as $value){
    array_push($arr, $value['student_id']);
  }
}

/*$query = Students::find()->where('id > 0')->andWhere('user_id IS NOT NULL');
if(!empty($arr)){
  $query->andWhere('id NOT IN (' . implode(',', $arr) . ')') ;
}
*/
 $searchmodel = new \app\models\StudentsSearch();
 $dataProvider = $searchmodel->search(Yii::$app->request->queryParams);
 $dataProvider->query->andWhere(['>', 'students.id', '0']);
 $dataProvider->query->andWhere(['IS NOT', 'user_id', NULL]);

  if(!empty($arr)){
    $dataProvider->query->andWhere(['NOT IN', 'students.id', implode(',', $arr)]);
  }
 /* echo '<pre>';
  print_r ($studentsInGroup);
  echo '</pre>';*/


 echo Html::beginForm(['add-students', 'post', [
     'groupId' => $groupId
 ]]);

 echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchmodel,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'userFullName',
            ['class' => 'yii\grid\CheckboxColumn',
             'checkboxOptions' => function($model)  {
                return ['value' => $model->id];
             }
             ],
        ],
    ]);
         echo Html::submitButton('Добавить выбранные', [
             'class' => 'btn btn-primary'
         ]);    
    echo Html::endForm();



