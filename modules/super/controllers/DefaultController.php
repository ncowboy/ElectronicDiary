<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;



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
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['super_module']
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
        return $this->redirect('/super');
    }
}
