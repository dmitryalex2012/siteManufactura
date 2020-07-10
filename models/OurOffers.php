<?php

namespace app\models;

use yii\db\ActiveRecord;

class OurOffers extends ActiveRecord
{
    /**
     * Find data about our offers
     *
     * @return array|ActiveRecord[]
     */
    public static function findOurOffers()
    {
        return static::find()->all();
    }
}