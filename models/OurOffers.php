<?php

namespace app\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class OurOffers extends ActiveRecord
{
    /**
     * Find data about our offers
     *
     * @return array|ActiveRecord[]
     * @throws InvalidConfigException
     */
    public static function findOurOffers()
    {
        return static::find()->all();
    }
}