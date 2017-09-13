<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * Description of PersonalController
 *
 * @author i.borisov
 */
class PersonalController extends Controller {
    public function actionIndex(){
        return $this->render('index');
    }
}
