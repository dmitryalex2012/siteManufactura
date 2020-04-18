<?php

namespace app\controllers;

use app\models\OurOffers;
use app\models\Works;
use Yii;
use yii\web\Controller;
use app\models\ContactForm;


class SiteController extends Controller
{
    public function actionIndex()
    {
        $ourOffers = ouroffers::find()->all();      // "ourOffers" - associative array from DB with data about our offers: curtains,
                                                    //   pillows, linens, towels, Apero, baby products.
        return $this->render('index', [       // This data (like the photo address, the inscription on the card and button,
            'ourOffers' => $ourOffers,              //   names controller/view for redirect ) is used for display of the cards
        ]);                                         //   with our offers.
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
        $items = Works::find()->all();          // "Works"  - associative array from DB with data about our works.
        return $this->render('works', [    // This data (like the photo address, photo description)  is used for display
            'worksList' => $items,              //   of the cards with our works and it description.
        ]);
    }

}