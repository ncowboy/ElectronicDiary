<?php

namespace app\controllers;

use Yii;
use app\models\Lessons;
use app\models\LessonsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use app\models\StudentsInLesson;
use app\models\Teachers;
use app\models\Groups;

/**
 * LessonsController implements the CRUD actions for Lessons model.
 */
class LessonsController extends Controller
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
     * Lists all Lessons models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LessonsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lessons model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    if($this->isAllowedTeacher($id) || \Yii::$app->user->can('all')) {
      return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
     }
     else {
       throw new ForbiddenHttpException('Вам запрещено просматривать уроки групп, не закрепленных за вами');
     }
      
     
    }

    /**
     * Creates a new Lessons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lessons();
          if (\Yii::$app->user->can('all')) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->setStudentsInLessons($model->id);
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
          } else {
                throw new ForbiddenHttpException('Вам запрещено создавать уроки');
              } 
    }

    /**
     * Updates an existing Lessons model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
          if($this->isAllowedTeacher($id) || \Yii::$app->user->can('all')) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->setStudentsInLessons($id);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            } 
          } else {
            throw new \yii\web\ForbiddenHttpException('Запрещено редактировать уроки групп, не закрепленных за вами');
              } 
    }

    /**
     * Deletes an existing Lessons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      if(\Yii::$app->user->can('all')) {  
      $this->findModel($id)->delete();
        return $this->redirect(['index']);
     }else{
       throw new ForbiddenHttpException('Вам запрещено удалять уроки');
     }
    }
    
     public function actionResults($id)        
    {
         return $this->redirect(['/students-in-lesson', 'id' => $id] );    
        }

    /**
     * Finds the Lessons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lessons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lessons::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function isAllowedTeacher($id) {
     $lesson = $this->findModel($id);
     $group = Groups::findOne(['id' => $lesson->group_id]);
     $teacher = Teachers::findOne(['id' => $group->teacher_id]);
     return \Yii::$app->user->id === $teacher->user_id; 
     
    }
       
  
}
