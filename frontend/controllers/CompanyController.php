<?php

namespace frontend\controllers;

use common\models\Company;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * CompanyJobController implements the CRUD actions for Job model.
 */
class CompanyController extends Controller
{
    public $defaultAction = 'dashboard';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true
                    ],
                ]
            ]
        ];
    }

    /**
     * Shows company page (identified by $id)
     * @param int $id id of the company
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
