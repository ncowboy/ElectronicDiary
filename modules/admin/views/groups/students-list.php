  <?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Students;
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

$query = Students::find()->where('id > 0')->andWhere('user_id IS NOT NULL');
if(!empty($arr)){
  $query->andWhere('id NOT IN (' . implode(',', $arr) . ')') ;
}


 $dataProvider = new ActiveDataProvider([
     'query' => $query,
     'pagination' => false
 ]);
 echo Html::beginForm(['add-students', 'post', [
     'groupId' => $groupId
 ]]);

 echo GridView::widget([
        'dataProvider' => $dataProvider,
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



