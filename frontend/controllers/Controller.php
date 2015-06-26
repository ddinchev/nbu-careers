<?php

namespace frontend\controllers;

use Carbon\Carbon;
use Yii;

class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        // TODO: Write a carbon wrapper
        Carbon::setLocale(explode('-', Yii::$app->language)[0]);
        return parent::beforeAction($action);
    }
}