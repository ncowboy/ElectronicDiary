<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\GroupsSearch;
use app\models\LessonsSearch;
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
    
    public function actionMyGroups(){
      if(Yii::$app->user->identity->user_role == 4) {
        $searchModel = new GroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('my-groups', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider
        ]);
      }
    }
    
    public function actionMyLessons(){
      if(Yii::$app->user->identity->user_role == 4) {
        $searchModel = new LessonsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('my-lessons', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider
        ]);
      }
    }
}
