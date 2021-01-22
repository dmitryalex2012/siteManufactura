<?php

namespace app\services;

use app\models\Services;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class ServicesServices
{
    /**
     * Find information about our services
     *
     * @return array|ActiveRecord[]
     * @throws InvalidConfigException
     */
    public static function getOurServices()
    {
        return Services::findOurServices();
    }
}