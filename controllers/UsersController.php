<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\ExcelForm;
use PHPExcel_Shared_Date;
use yii\web\ForbiddenHttpException;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
                        'roles' => ['user_index']
                    ],
                ],
            ],
            
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionShow()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('show', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   public function actionChangepass($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!\Yii::$app->user->can('users_admin_crud') && $model->user_role == 1) {
                throw new ForbiddenHttpException('Вам запрещено изменять пароль администраторов');
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('changepass', [
                'model' => $model,
            ]);
        }
    }
    
    
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post())) {
            if (!\Yii::$app->user->can('users_admin_crud') && $model->user_role == 1) {
                throw new ForbiddenHttpException('Вам запрещено добавление администраторов');
            }
             $model->save();
             return $this->redirect(['view', 'id' => $model->id]);
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       if ($model->load(Yii::$app->request->post())) {
            if (!\Yii::$app->user->can('users_admin_crud') && $model->user_role == 1) {
                throw new ForbiddenHttpException('Вам запрещено редактирование администраторов');
            }
             $model->save();
             return $this->redirect(['view', 'id' => $model->id]);
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!\Yii::$app->user->can('users_admin_crud') && $model->user_role == 1){
            throw new ForbiddenHttpException('Вам запрещено удаление администраторов');
        }
        else {
        $model->delete();
        return $this->redirect(['show']);
        }
    }

    public function actionUpload(){
        $model = new ExcelForm;
    
    if($model->load(Yii::$app->request->post())){
        $file = UploadedFile::getInstance($model,'file');
        $filename = 'Data.'.$file->extension;
        $upload = $file->saveAs('uploads/'.$filename);
        if($upload){
            define('FILE_PATH','uploads/');
            $xls_file = FILE_PATH . $filename;
            $objPHPExcel = \PHPExcel_IOFactory::load($xls_file);
            $objPHPExcel->setActiveSheetIndex(0);
            $aSheet = $objPHPExcel->getActiveSheet();
            $users = [];
            foreach($aSheet->getRowIterator() as $row){
              $cellIterator = $row->getCellIterator();
              $user = [];
              foreach($cellIterator as $cell){
                  $val = $cell->getCalculatedValue();
              if(PHPExcel_Shared_Date::isDateTime($cell)) {    
                array_push($user, date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($val)));
              }
              else {
              array_push($user, $val);
              }
            }
            array_push($users, $user);
            }
            foreach($users as $user){
               $modelnew = new Students();
               $modelnew->name = $user[0];
               $modelnew->email = $user[1];
               $modelnew->phone_number = $user[2];
               $modelnew->parents_number = $user[3];
               $modelnew->birth = $user[4];
               $modelnew->save(); 
            }
            unlink('uploads/'.$filename);
            return $this->redirect(['index']);
        }
    }else{
        return $this->render('upload',['model'=>$model]);
    }
}

    
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
