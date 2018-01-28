<?php

namespace app\modules\super\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\helpers\Hasher;
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
                        'roles' => ['super_module']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
        if($model->user_role == 1) {
          throw new ForbiddenHttpException('Вы не можете изменять пароль администратора');
        } else {
            if ($model->load(Yii::$app->request->post())) {
                $model->password = Hasher::hash($model->password);
                if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
              }
                } else{
                   return $this->render('changepass', [
                        'model' => $model,
                    ]);
                 }
         }
    }
    
    public function actionCreate()
    {
            $model = new Users();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ( $model->user_role == 1) {
                throw new ForbiddenHttpException('Вам запрещено добавление администраторов');
            }else{
              $model->save(); 
            }
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
         if($model->user_role == 1) {
           throw new ForbiddenHttpException('Вам запрещено назначение администраторов');
         }else{
            $model->save();
         }
               return $this->redirect(['view', 'id' => $model->id]);
            } else {
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
        if ($model->user_role !== 1) {
          $model->delete();
        }else{
           throw new ForbiddenHttpException('Вам запрещено удалять администраторов');
           }
        return $this->redirect(['/users']);
        
    }
    
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрошенная страница не существует');
        }
    }
    
}
    
