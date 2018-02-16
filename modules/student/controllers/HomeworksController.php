<?php

namespace app\modules\student\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\MyAccessControl; 
use app\modules\student\models\StudentLessonsSearch;





class HomeworksController extends Controller
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
      $searchModel = new StudentLessonsSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      return $this->render('index', [
        'dataProvider' => $dataProvider
      ]);
    }
}
