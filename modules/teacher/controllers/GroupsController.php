<?php

namespace app\modules\teacher\controllers;

use Yii;
use app\models\Groups;
use app\modules\teacher\models\TeacherGroupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\StudentsInGroup;
use yii\web\ForbiddenHttpException;
use app\models\StudentsSearch;


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
                        'roles' => ['teacher_module']
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
        $searchModel = new TeacherGroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'params' => Yii::$app->request->queryParams
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
      $user = Yii::$app->user;
        if ($model->teachers->user->id !== $user->id){
           throw new ForbiddenHttpException('Вам запрещено просматривать группы, не закрепленные за вами');
        }else{
      return $this->render('view', [
        'model' => $model,
      ]);
        }
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
        $user = Yii::$app->user;
        if($model->teachers->user->id !== $user->id) {
           throw new ForbiddenHttpException('Вам запрещено редактировать группы, не закрепленные за вами');
           
        }else{
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return $this->redirect(['view', 'id' => $model->id]);
                  } else {
                       return $this->render('update', [
                          'model' => $model,
                          ]);
                    } 
        }        
    }
    
     public function actionGroupContent($id)
    {
      $model = $this->findModel($id);
      $user = Yii::$app->user;
        if($model->teachers->user->id !== $user->id) {
           throw new ForbiddenHttpException('Вам запрещено просматривать группы, не закрепленные за вами');
        }else{
          $studentsSearchModel = new StudentsSearch();
          $studentsDataProvider = $studentsSearchModel->search(Yii::$app->request->queryParams);
          $studentsDataProvider->setPagination(['pageSize' => 15]);
          $studentsInGroup = StudentsInGroup::findAll(['group_id' => $id]);
          $ids = [];
          foreach ($studentsInGroup as $student){
            array_push($ids, $student['student_id']);
          }
          $studentsDataProvider->query->having(['id' => $ids]);

          return $this->render('group-content', [
            'model' => $model,
            'studentsSearchModel' => $studentsSearchModel,
            'studentsDataProvider' => $studentsDataProvider,
          ]);
        }  
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
        return $this->redirect('/teacher/groups/group-content?id=' . $_REQUEST[2]['groupId']);
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
