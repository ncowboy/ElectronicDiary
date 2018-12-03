<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Lessons;
use app\models\LessonsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;


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
                        'roles' => ['admin_module']
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
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Lessons model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
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
              return $this->redirect(['/admin/lessons']);
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
          } else {
            return $this->render('update', [
              'model' => $model,
            ]);
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
      $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    
     public function actionResults($id)        
    {
         return $this->redirect(['/admin/students-in-lesson', 'id' => $id] );    
        }
        
    public function actionHomework($id) {
         $model = $this->findModel($id);
            return $this->render('homework', [
                  'model' => $model
            ]);
     }
     
     public function actionHomeworkUpdate($id) {
         $model = $this->findModel($id);
         if($model->load(Yii::$app->request->post()) && $this->filesUpload($id) && $model->save()){
           return $this->redirect(['/admin/lessons/homework', 'id' => $model->id]);
        }else {
                return $this->render('homework-update', [
                    'model' => $model
                ]);
            }
     }
     
     public function actionAddHomework($id) {
        $model = $this->findModel($id); 
        if ($model->load(Yii::$app->request->post()) && $this->filesUpload($id) && $model->save()) {
            return $this->redirect(['/admin/lessons/homework', 'id' => $model->id]);
        }else{
                return $this->render('add-homework', [
              'model' => $model,
            ]);  
        }
     }
     
     public function actionFileDelete($src, $lessonId) {
       if(file_exists($src) && unlink($src)){
        return $this->redirect(['/admin/lessons/homework-update', 'id' => $lessonId]);
       }
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
}
