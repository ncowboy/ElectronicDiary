<?php

namespace app\controllers;

use Yii;
use app\models\StudentsInLesson;
use app\models\StudentsInLessonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Lessons;
use yii\helpers\Json;

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
               echo $out;
               return;
           }
            else {
               $model->attendance = 1;
               $model->save();
               return $this->refresh();
            }
         };
         //  echo $editableParam;
          // var_dump ($editableParam !== "mark_homework");         
         //  echo $out;
                
        
    }
         
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'lesson_id' => $id
        ]);
        
    }
    
    public function actionResults($id) {
         $dataProvider = new ActiveDataProvider([
        'query' => StudentsInLesson::find()->where([
            'lesson_id' => $id
        ])
            ]);
         $lesson = Lessons::findOne($id);
            return $this->render('results', [
            'dataProvider' => $dataProvider,
            'lesson' => $lesson
         ]);  
         
    }
    /**
     * Displays a single StudentsInLesson model.
     * @param integer $lesson_id
     * @param integer $student_id
     * @return mixed
     */
    public function actionView($lesson_id, $student_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($lesson_id, $student_id),
        ]);
    }

    /**
     * Creates a new StudentsInLesson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentsInLesson();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'lesson_id' => $model->lesson_id, 'student_id' => $model->student_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentsInLesson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $lesson_id
     * @param integer $student_id
     * @return mixed
     */
    public function actionUpdate($lesson_id, $student_id)
    {
        $model = $this->findModel($lesson_id, $student_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'lesson_id' => $model->lesson_id, 'student_id' => $model->student_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StudentsInLesson model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $lesson_id
     * @param integer $student_id
     * @return mixed
     */
    public function actionDelete($lesson_id, $student_id)
    {
        $this->findModel($lesson_id, $student_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentsInLesson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $lesson_id
     * @param integer $student_id
     * @return StudentsInLesson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($lesson_id, $student_id)
    {
        if (($model = StudentsInLesson::findOne(['lesson_id' => $lesson_id, 'student_id' => $student_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
