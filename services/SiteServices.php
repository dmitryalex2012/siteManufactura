<?php

namespace app\services;

use app\models\OurOffers;

class SiteServices
{
    /**
     * Get data of our offers
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getOurOffers()
    {
        return OurOffers::findOurOffers();
    }
}