<?php

namespace app\services;

use app\models\OurOffers;

class SiteService
{
    /**
     * Get list of our products
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getOurOffers()
    {
        return OurOffers::findOurOffers();
    }
}