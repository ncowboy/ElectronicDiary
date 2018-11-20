<?php

namespace app\modules\admin\controllers;

use app\models\StudentsSearch;
use app\models\TeachersSearch;
use Yii;
use app\models\Groups;
use app\models\GroupsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\StudentsInGroup;
use app\models\UsersSearch;

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
                        'roles' => ['admin_module']
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


    public function actionView($id)
    {
      $model = $this->findModel($id);
      return $this->render('view', [
        'model' => $model,
      ]);
    }

    /**
     * Creates a new Groups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $model = new Groups();
      if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
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
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionTeachersList()
    {
        $searchModel = new TeachersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('teachers-list', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionTeacherSet($group_id, $teacher_id)
    {
          $model = $this->findModel($group_id);
          $model->teacher_id = $teacher_id;
          $model->save();
          return $this->redirect('/admin/groups/group-content?id=' . $group_id);
    }
    
    public function actionCuratorSet($group_id, $curator_id)
    {
          $model = $this->findModel($group_id);
          $model->curator_userid = $curator_id;
          $model->save();
          return $this->redirect('/admin/groups/group-content?id=' . $group_id);
    }
    
    public function actionDelete($id)
    {
      $this->findModel($id)->delete();
      return $this->redirect(['/groups']);
    }
    
     public function actionGroupContent($id)
    {
      $model = $this->findModel($id);
      $teachersSearchModel = new TeachersSearch();
      $teachersDataProvider = $teachersSearchModel->search(Yii::$app->request->queryParams);
      $teachersDataProvider->setPagination(['pageSize' => 15]);
      $studentsSearchModel = new StudentsSearch();
      $studentsDataProvider = $studentsSearchModel->search(Yii::$app->request->queryParams);
      $studentsDataProvider->setPagination(['pageSize' => 15]);
      $curatorsSearchModel = new UsersSearch();
      $curatorsDataProvider = $curatorsSearchModel->search(Yii::$app->request->queryParams);
      $curatorsDataProvider->query->andWhere(['user_role' => 3]);
      $curatorsDataProvider->setPagination(['pageSize' => 15]);
      $studentsInGroup = StudentsInGroup::findAll(['group_id' => $id]);
      $ids = [];
      foreach ($studentsInGroup as $student){
        array_push($ids, $student['student_id']);
      }
      $studentsDataProvider->query->having(['id' => $ids]);

      return $this->render('group-content', [
        'model' => $model,
        'teachersSearchModel' => $teachersSearchModel,
        'teachersDataProvider' => $teachersDataProvider,
        'studentsSearchModel' => $studentsSearchModel,
        'studentsDataProvider' => $studentsDataProvider,
        'curatorsSearchModel' => $curatorsSearchModel,
        'curatorsDataProvider' => $curatorsDataProvider
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
        return $this->redirect('/admin/groups/group-content?id=' . $_REQUEST[2]['groupId']);
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
