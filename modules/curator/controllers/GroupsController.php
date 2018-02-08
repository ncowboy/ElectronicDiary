<?php

namespace app\modules\curator\controllers;

use Yii;
use app\models\Groups;
use app\models\GroupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\StudentsInGroup;

/**
 * GroupsController implements the CRUD actions for Groups model.
 */
class GroupsController extends Controller
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
                        'roles' => ['curator_module']
                    ],
                ],
            ],
      ];
    }

    /**
     * Lists all Groups models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Groups model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      return $this->render('view', [
        'model' => $model,
      ]);
    }


    /**
     * Updates an existing Groups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else if ($model->curator_userid == Yii::$app->user->identity->id){
            return $this->render('update', [
                'model' => $model,
            ]);
         }else{
           throw new \yii\web\ForbiddenHttpException('Вам запрещено редактировать данную группу');
         } 
    }
    
     public function actionGroupContent($id)
    {
      $model = $this->findModel($id);
      return $this->render('group-content', [
        'model' => $model
      ]);  
    }
    
    public function actionAddStudents()
    {
         if(isset($_REQUEST['selection']))
    {             
        foreach ($_REQUEST['selection'] as $value) {
        $model = new StudentsInGroup;
        $model->group_id = $_REQUEST[2]['groupId'];
        $model->student_id = $value;
        $model->save();
      }
    }
        return $this->redirect('/curator/groups/group-content?id=' . $_REQUEST[2]['groupId']);
    }

    /**
     * Finds the Groups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Groups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Groups::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрошенная страница не существует');
        }
    }
    
}