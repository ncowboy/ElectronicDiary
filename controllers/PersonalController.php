<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\Teachers;
use app\models\Students;


class PersonalController extends Controller {
   
    
    public function actionIndex() {
      $user = Yii::$app->user; 
      $model = Users::findOne([$id = $user->id]);
      
      if($user->identity->user_role == 5) {
          $student = Students::findOne([$user_id = $user_id]);
      } 
      if (!$user->isGuest) {
      return $this->render('index',[
          'model' => $model,
          'student' => $student,
          'user' => $user
              ]);
      }else{
          $this->redirect('login');
      }
      
    } 
    
    public function actionGroups(){
      if(Yii::$app->user->identity->user_role == 4) {
        $model = Teachers::findOne(Yii::$app->user->id);
        return $this->render('groups', [
          'model' => $model
        ]);
      }
    }
}
