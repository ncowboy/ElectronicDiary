<?php

namespace app\modules\teacher\controllers;

use Yii;
use app\models\Students;
use app\modules\teacher\models\TeacherStudentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\Teachers;
use app\models\Groups;
use app\models\StudentsInGroup;

/**
 * StudentsController implements the CRUD actions for Students model.
 */
class StudentsController extends Controller
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
     * Lists all Students models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherStudentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Students model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      if($this->isAlowedTeacher($id)) {  
        return $this->render('view', [
            'model' => $this->findModel($id)
         ]);
      }else{
          throw new ForbiddenHttpException('Вам запрещено просматривать профили студентов не из закреплённых групп');
      }
    }



    /**
     * Finds the Students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Students::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрошенная страница не существует');
        }
    }
    
       protected function isAlowedTeacher($studentId) {
        $teacher = Teachers::findOne(['user_id' => \Yii::$app->user->id]);
        $teacherGroups = Groups::findAll(['teacher_id' => $teacher->id]);
        $groupStudents = NULL;
        foreach($teacherGroups as $value){
          if(StudentsInGroup::findOne(['student_id' => $studentId, 'group_id' => $value['id']])){
            $groupStudents += 1;
          }
        }
        return $groupStudents;  
       }
}
