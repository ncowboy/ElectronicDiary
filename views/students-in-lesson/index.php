<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentsInLessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students In Lessons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-in-lesson-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Students In Lesson', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'lesson_id',
            'student_id',
            'attendance',
            'mark_work_at_lesson',
            'mark_homework',
            // 'mark_dictation',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
