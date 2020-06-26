<?php

namespace app\controllers;

use app\models\OurOffers;
use yii\web\Controller;


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
}