<?php

namespace app\modules\student\controllers;

use yii\web\Controller;
use app\models\MyAccessControl;
use app\models\Students;
use yii\data\ActiveDataProvider;
use app\models\Users;
use app\models\MailerForm;
use yii\filters\VerbFilter;



class MarksController extends Controller
{
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
                'class' => MyAccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['student_module'],
                    ],
                ],
            ],
            
        ];
    }
    
    public function actionIndex()
    {
      $userId = \Yii::$app->user->identity->id;
      $user = Users::findOne(['id' => $userId]);
      $userFullName = $user->userFullName;
      $student = Students::findOne(['user_id' => $userId]);
      $dataProvider = new ActiveDataProvider([
          'query' => \app\models\StudentsInLesson::find()->where(['student_id' => $student->id ]),
          'sort' => false
        ]);
      
      return $this->render('index', [
        'dataProvider' => $dataProvider,
        'user' => $userFullName,
        'id' => $student->id
      ]);
    }
    
    public function actionSendReport($id)
    {
      $student = Students::findOne(['id' => $id]); 
      $model = new MailerForm();
      $model->id = $id;
      $model->email = $student->parents_email;
      $model->fullName = $student->userFullName;
      if ($model->sendEmail()) {         
      return $this->redirect('/student/marks');
        }else {
         throw new NotFoundHttpException('Что-то пошло не так');
       }
    }
}
