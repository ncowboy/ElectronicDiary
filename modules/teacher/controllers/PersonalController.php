<?php
namespace app\modules\teacher\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;

class PersonalController extends Controller {
    
    public function actionIndex() {
      $user = Yii::$app->user; 
      $model = Users::findOne([$id = $user->id]);
      if (!$user->isGuest) {
      return $this->render('index',[
          'model' => $model,
          'user' => $user
              ]);
      }else{
          $this->redirect('login');
      }
    }
}
