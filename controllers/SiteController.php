<?php

namespace app\controllers;

use app\models\OurOffers;
use app\models\Works;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use yii\db\Query;


//use yii\views\site\contact;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $ourOffers = ouroffers::find()->all();       // "OurOffers() - object from DB with our offers data"

        return $this->render('index', [
            'ourOffers' => $ourOffers,
        ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionWorks()
    {
        $items = Works::find()->all();
        return $this->render('works', [
            'items' => $items,
        ]);
    }

}