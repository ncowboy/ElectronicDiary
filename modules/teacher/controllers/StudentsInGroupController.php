<?php

namespace app\modules\teacher\controllers;

use Yii;
use app\models\StudentsInGroup;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentsInGroupController implements the CRUD actions for StudentsInGroup model.
 */
class StudentsInGroupController extends Controller
{
    /**
     * @inheritdoc
     */
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
                        'roles' => ['teacher_module']
                    ],
                ],
            ],
        ];
    }
    
    public function actionMultipledelete()
    {
        if (\Yii::$app->request->post()) {
            $response = Yii::$app->request->post();
            foreach($response['students'] as $key => $value){      
                $this->findModel($response['group'], $response['students'][$key])->delete();
            };
        }
        $this->redirect(['/teacher/groups/group-content?id=' . $response['group']]);
        
    }
    

    /**
     * Finds the StudentsInGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $group_id
     * @param integer $student_id
     * @return StudentsInGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($group_id, $student_id)
    {
        if (($model = StudentsInGroup::findOne(['group_id' => $group_id, 'student_id' => $student_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не существует');
    }
}
