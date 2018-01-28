<?php

namespace app\modules\teacher\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\MyAccessControl;



/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
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
                        'roles' => ['teacher_module'],
                    ],
                ],
            ],
            
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('/teacher/personal');
    }
}
