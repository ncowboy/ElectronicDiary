<?php

namespace app\modules\teacher\controllers;

use Yii;
use app\models\Lessons;
use app\models\Groups;
use app\models\Teachers;
use app\modules\teacher\models\TeacherLessonsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;





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
                        'roles' => ['teacher_module']
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
        $searchModel = new TeacherLessonsSearch();
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
      if($this->isAllowedTeacher($id)){  
        return $this->render('view', [
              'model' => $this->findModel($id)
          ]);
      }else{
          throw new ForbiddenHttpException('Вам запрещено просматривать уроки групп, не закрепленных за вами');
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
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->setStudentsInLessons($id);
            return $this->redirect(['view', 'id' => $model->id]);
          } else if($this->isAllowedTeacher($id)) {
            return $this->render('update', [
              'model' => $model,
            ]);
          }else{
             throw new ForbiddenHttpException('Вам запрещено редактировать уроки групп, не закрепленных за вами'); 
        }
    }
    
     public function actionResults($id){
         if($this->isAllowedTeacher($id)){
         return $this->redirect(['/teacher/students-in-lesson', 'id' => $id] );    
        }else{
            throw new ForbiddenHttpException('Вам запрещено просматривать оценки студентов из групп, не закрепленных за вами');
        }
     }
     
     public function actionAddHomework($id) {
       $model = $this->findModel($id);
           if (Yii::$app->request->isPost) {
            $model->hw_file = UploadedFile::getInstances($model, 'hw_file');
            if ($model->hw_file && $model->validate()) {
              foreach ($model->hw_file as $value) {
                $value->saveAs('uploads/' . $value->baseName . '.' . $value->extension);
              } 
            $model->hw_file = implode(',', $model->hw_file);
            $model->save();
              
            }
            
          }
         return $this->render('add-homework', [
           'model' => $model,
         ]);
   
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
            throw new NotFoundHttpException('Запрошенная страница не существует');
        }
    }
    
    protected function isAllowedTeacher($id) {
     $lesson = $this->findModel($id);
     $group = Groups::findOne(['id' => $lesson->group_id]);
     $teacher = Teachers::findOne(['id' => $group->teacher_id]);
     return \Yii::$app->user->id === $teacher->user_id; 
     
    }
}
