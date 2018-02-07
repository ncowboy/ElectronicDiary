<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Users;
use app\models\MailerForm;
use app\models\Students;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {  
      if (!Yii::$app->user->isGuest) {
        $user = Users::findOne(['id' => Yii::$app->user->identity->id]);  
        return $this->redirect('/' . $user->userRoleName . '/personal'); 
      }else{
          return $this->render('index');
      }
      
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()   {
       if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = Users::findOne(['id' => Yii::$app->user->identity->id]);
        return $this->redirect($user->userRoleName . '/personal'); 
          }else{
            return $this->render('login', [
            'model' => $model,
        ]);
      }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionSendStudentReports() {
      $students = Students::find()->all();
      foreach ($students as $value) {
        $student = Students::findOne(['id' => $value->id]);
        $email = new MailerForm();
        $email->createFile();
        $email->id = $student->id;
        $email->email = $student->parents_email;
        $email->fullName = $student->userFullName;
        $email->sendEmail();
        }
        
        return $this->redirect('/site/index');
       }
      
    
    
  
}
