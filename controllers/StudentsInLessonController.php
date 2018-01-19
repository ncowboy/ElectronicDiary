<?php

namespace app\controllers;

use Yii;
use app\models\StudentsInLesson;
use app\models\StudentsInLessonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Groups;
use app\models\Teachers;
use app\models\Lessons;
use yii\helpers\Json;
use yii\web\ForbiddenHttpException;

/**
 * StudentsInLessonController implements the CRUD actions for StudentsInLesson model.
 */
class StudentsInLessonController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
              'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['menu_lessons']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all StudentsInLesson models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new StudentsInLessonSearch([
            'lesson_id' => $id
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         if (Yii::$app->request->post('hasEditable')) {
         $ids = Yii::$app->request->post('editableKey');
         $editableParam = Yii::$app->request->post('editableAttribute');
         $ids_parse = Json::decode($ids);
         $lessonId = $ids_parse['lesson_id'];
         $studentId = $ids_parse['student_id'];
         $model = $this->findModel($lessonId, $studentId);
         $post = [];
         $out = Json::encode(['output'=>'', 'message'=>'']);
         $posted = current($_POST['StudentsInLesson']);
         $post['StudentsInLesson'] = $posted;
         if($model->load($post)) {
           if ($editableParam === "mark_homework") {
               $model->save();
               return $this->refresh() ;
           }
            else {
               $model->attendance = 1;
               $model->save();
               return $this->refresh();
            }
         };
    }
        if($this->isAllowedTeacher($id) || \Yii::$app->user->can('all')){
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'lesson_id' => $id
        ]);
        }else{
          throw new ForbiddenHttpException('Запрещено редактировать оценки групп, не закрепленных за вами');
        }
    }
    
  
     protected function isAllowedTeacher($lesson_id) {
     $lesson = Lessons::findOne(['id' => $lesson_id]);  
     $group = Groups::findOne(['id' => $lesson->group_id]);
     $teacher = Teachers::findOne(['id' => $group->teacher_id]);
     return \Yii::$app->user->id === $teacher->user_id; 
     
    }
}
