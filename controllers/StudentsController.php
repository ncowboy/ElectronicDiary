<?php

namespace app\controllers;

use Yii;
use app\models\Students;
use app\models\Users;
use app\models\StudentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\Teachers;
use app\models\Groups;
use app\models\StudentsInGroup;

/**
 * StudentsController implements the CRUD actions for Students model.
 */
class StudentsController extends Controller
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
                        'roles' => ['menu_students']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Students models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Students model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      if($this->isAlowedTeacher($id) || \Yii::$app->user->can('all')) {
      return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
      }else{
        throw new ForbiddenHttpException('Вам запрещено просматривать профили студентов');
      }
    }

    /**
     * Creates a new Students model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      if(Yii::$app->user->can('all')) {
        $student = new Students();
        $user = new Users();
        $user->user_role = 5;

        if ($student->load(Yii::$app->request->post()) && $student->save() && $user->load(Yii::$app->request->post()) && $user->save()) {
              $student->user_id = $user->id;
              $student->save();
              return $this->redirect(['view', 'id' => $student->id]);
        } else {
            return $this->render('create', [
                'student' => $student,
                'user' => $user
            ]);
        }
      }else{
        throw new ForbiddenHttpException('Вам запрещено добавлять студентов');
      }
      
    }

    /**
     * Updates an existing Students model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('all')) {
          $model = $this->findModel($id);

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return $this->redirect(['view', 'id' => $model->id]);
          } else {
              return $this->render('update', [
                  'model' => $model,
              ]);
          }
        }else{
          throw new ForbiddenHttpException('Вам запрещено редактировать учеников');
        }  
    }

    /**
     * Deletes an existing Students model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       if(Yii::$app->user->can('all')) {
        $student = $this->findModel($id);
        $user = Users::findOne($id = $student->user_id);
        $user->delete();
        $student->delete();
        return $this->redirect(['index']);
       }else{
         throw new ForbiddenHttpException('Вам запрещено удалять студентов');
       }  
    }

    /**
     * Finds the Students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Students::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function isAlowedTeacher($studentId) {
      $teacher = Teachers::findOne(['user_id' => \Yii::$app->user->id]);
      $teacherGroups = Groups::findAll(['teacher_id' => $teacher->id]);
      $groupStudents = NULL;
      foreach($teacherGroups as $value){
        if(StudentsInGroup::findOne(['student_id' => $studentId, 'group_id' => $value['id']])){
          $groupStudents += 1;
        }
      }
     return $groupStudents;  
    }
}
