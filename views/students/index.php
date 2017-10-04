<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Студенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 

    ?>

    <p>
        <?= Html::a('Добавить студента', ['Добавить'], ['class' => 'btn btn-success']) ?>
    </p>
      <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'userFullName',
                'groupsAsString',
                'phone_number',
                'parents_name',
                'parents_number',
                'birth',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);

         ?>
     </div>     
</div>
