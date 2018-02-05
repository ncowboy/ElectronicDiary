<?php

namespace app\modules\student\controllers;

use yii\web\Controller;
use app\models\Students;
use yii\data\ActiveDataProvider;
use app\models\Users;



class MarksController extends Controller
{
    
    public function actionIndex()
    {
      $userId = \Yii::$app->user->identity->id;
      $user = Users::findOne(['id' => $userId]);
      $userFullName = $user->userFullName;
      $studentId = Students::findOne(['user_id' => $userId]);
      $dataProvider = new ActiveDataProvider([
          'query' => \app\models\StudentsInLesson::find()->where(['student_id' => $studentId ]),
          'sort' => false
        ]);
      
      return $this->render('index', [
        'dataProvider' => $dataProvider,
        'user' => $userFullName
      ]);
    }
}
