<?php

namespace app\modules\curator\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;



/**
 * Default controller for the `curator` module
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
                'class' => \app\models\MyAccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['curator_module']
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
        return $this->redirect('/curator');
    }
}
