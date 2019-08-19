<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

/*Controller for pages site */

class PageController extends Controller
{
    /*
     For products list page
     */
    public function actionListproducts()
    {
        return $this->render('listproducts');
    }

}
