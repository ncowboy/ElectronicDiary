<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Groups;
use app\models\GroupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
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
                        'roles' => ['menu_groups']
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
        $user = Yii::$app->user;
        if (!($user->can('all') || $user->can('view_all') || $user->can('groups_crud_self') && $model->teachers->user->id == $user->id))  {
           throw new ForbiddenHttpException('Вам запрещено просматривать группы, не закрепленные за вами');
        }else{
        return $this->render('view', [
            'model' => $model,
        ]);
        }
    }

    /**
     * Creates a new Groups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!(Yii::$app->user->can('all') || Yii::$app->user->can('groups_crud'))){
            throw new ForbiddenHttpException('Вам запрещено создавать группы');
        } else {
            $model = new Groups();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
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
        if(!($user->can('all') || \Yii::$app->user->can('groups_crud_self') && $model->teachers->user->id == \Yii::$app->user->id)) {
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
    public function actionTeachersList()
    {
        return $this->render('teacher-list');
    }
    
    public function actionTeacherSet($group_id, $teacher_id)
    {
          $model = $this->findModel($group_id);
          $model->teacher_id = $teacher_id;
          $model->save();
          return $this->redirect('/groups/group-content?id=' . $group_id);
    }
    
    public function actionDelete($id)
    {
        if(!(Yii::$app->user->can('all') || Yii::$app->user->can('groups_crud'))){
            throw new ForbiddenHttpException('Вам запрещено удалять группы');
        } else {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
      }
    }
    
     public function actionGroupContent($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user;
        if(!($user->can('all') || $user->can('view_all') || \Yii::$app->user->can('groups_crud_self') && $model->teachers->user->id == \Yii::$app->user->id)) {
           throw new ForbiddenHttpException('Вам запрещено просматривать группы, не закрепленные за вами');
        }else{
        return $this->render('group-content', [
            'model' => $model
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
     
                 return $this->redirect('/groups/group-content?id=' . $_REQUEST[2]['groupId']);
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
