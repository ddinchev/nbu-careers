<?php

namespace frontend\modules\user\controllers;

use common\base\MultiModel;
use common\models\Company;
use common\models\UserProfile;
use frontend\modules\user\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::className(),
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::className()
            ]
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['index'], 'allow' => true, 'roles' => ['@']],
                    ['actions' => ['company-profile'], 'allow' => true, 'roles' => ['company']],
                    ['actions' => ['user-profile'], 'allow' => true, 'roles' => ['user']],

                ]
            ]
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $accountModel = new AccountForm();
        $accountModel->setUser(Yii::$app->user->identity);

        $model = new MultiModel([
            'models' => [
                'account' => $accountModel,
                'profile' => Yii::$app->user->identity->userProfile
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => Yii::t('frontend', 'Your account has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('index', ['model' => $model]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionUserProfile()
    {
        /**
         * @var $model UserProfile
         */
        $model = Yii::$app->user->identity->userProfile;
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => Yii::t('frontend', 'Your profile has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('user-profile', ['model' => $model]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCompanyProfile()
    {
        /**
         * @var $model Company
         */
        $model = Yii::$app->user->identity->company;
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => Yii::t('frontend', 'Your profile has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('company-profile', ['model' => $model]);

    }
}
