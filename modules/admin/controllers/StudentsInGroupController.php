<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\StudentsInGroup;
use app\models\StudentsInGroupSearch;
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
                        'roles' => ['admin_module']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all StudentsInGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentsInGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($group_id, $student_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($group_id, $student_id),
        ]);
    }

    public function actionCreate()
    {
        $model = new StudentsInGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'group_id' => $model->group_id, 'student_id' => $model->student_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($group_id, $student_id)
    {
        $model = $this->findModel($group_id, $student_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'group_id' => $model->group_id, 'student_id' => $model->student_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($group_id, $student_id)
    {
        $this->findModel($group_id, $student_id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionMultipledelete()
    {
        if (\Yii::$app->request->post()) {
            $response = Yii::$app->request->post();
            foreach($response['students'] as $key => $value){
                $this->findModel($response['group'], $response['students'][$key])->delete();
            };
        }
        $this->redirect(['/admin/groups/group-content?id=' . $response['group']]);
        
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
