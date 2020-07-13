<?php

namespace app\controllers;

use app\services\SiteServices;
use yii\web\Controller;


class SiteController extends Controller
{
    /**
     * Render from DB the associative array "ourOffers" with data about our offers: curtains, pillows, linens, towels, Apero, baby products.
     * This data (like the photo address, the inscription on the card and button, names controller/view for redirect ) is used for
     * display of the cards with our offers.
     *
     * @return string
     */
    public function actionIndex()
    {
        $ourOffers = SiteServices::getOurOffers();

        return $this->render('index', [
            'ourOffers' => $ourOffers,
        ]);
    }
}