<?php

namespace app\controllers;

use app\models\Services;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use yii\db\Query;

//use yii\views\site\contact;

class ServicesController extends Controller
{
     public function actionList()
    {
        $items = Services::find()->all();
        return $this->render('list', [
            'items' => $items,
        ]);
    }
}
