<?php

namespace app\controllers;

use app\services\SiteService;
use yii\web\Controller;


class SiteController extends Controller
{
    /**
     * The service to handle offers
     *
     * @var SiteService
     */
    private $offerServices;

    public function __construct($id, $module, $config = [])
    {
        $this->offerServices = new SiteService();

        parent::__construct($id, $module, $config);
    }


    /**
     * @return string
     */
    public function actionIndex()
    {
        /**
         * The "ourOffers" is associative array from DB with data about our offers: curtains, pillows, linens, towels, Apero, baby products.
         * This data (like the photo address, the inscription on the card and button, names controller/view for redirect ) is used for
         * display of the cards with our offers.
         */

        $ourOffers = $this->offerServices->getOurOffers();

        return $this->render('index', [
            'ourOffers' => $ourOffers,
        ]);
    }
}