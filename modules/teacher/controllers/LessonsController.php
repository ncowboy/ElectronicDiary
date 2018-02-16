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
use yii\helpers\FileHelper;





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
     * Creates a new Lessons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lessons();
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->setStudentsInLessons($model->id);
              return $this->redirect(['/teacher/lessons']);
            } else {
              return $this->render('create', [
                'model' => $model,
            ]);
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
     
     
     
     public function actionHomework($id) {
         $model = $this->findModel($id);
         if($this->isAllowedTeacher($id)){  
            return $this->render('homework', [
                  'model' => $model
            ]);
                }else{
             throw new ForbiddenHttpException('Вам запрещено просматривать уроки групп, не закрепленных за вами');
        }    
     }
     
     public function actionHomeworkUpdate($id) {
         $model = $this->findModel($id);
         if($model->load(Yii::$app->request->post()) && $this->filesUpload($id) && $model->save()){
           return $this->redirect(['/teacher/lessons/homework', 'id' => $model->id]);
        }else if(!$this->isAllowedTeacher($id)) {
                throw new ForbiddenHttpException('Вам запрещено просматривать уроки групп, не закрепленных за вами');
            } else {
                return $this->render('homework-update', [
                    'model' => $model
                ]);
            }
     }
     
     public function actionAddHomework($id) {
        $model = $this->findModel($id); 
        if ($model->load(Yii::$app->request->post()) && $this->filesUpload($id) && $model->save()) {
            return $this->redirect(['/teacher/lessons/homework', 'id' => $model->id]);
        }else{
            return $this->render('add-homework', [
           'model' => $model,
         ]);
            
        }
     }
     
     public function actionFileDelete($src, $lessonId) {
       if(file_exists($src) && unlink($src)){
        return $this->redirect(['/teacher/lessons/homework-update', 'id' => $lessonId]);
       }
     }

  
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
    protected function filesUpload($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
           $model->hw_files = UploadedFile::getInstances($model, 'hw_files');
            if ($model->hw_files && $model->validate()) {
             $dir = 'uploads/hw/lesson' . $model->id . '/';
             if(!is_dir($dir)){
                 FileHelper::createDirectory($dir);
             }
              foreach ($model->hw_files as $value) {
                $value->saveAs($dir . $value->baseName . '.' . $value->extension);
              }
             }
           }    
        return $model->save();    
    }
}
