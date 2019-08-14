<?php

namespace app\controllers;

use app\models\Singer;
use yii\helpers\VarDumper;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}