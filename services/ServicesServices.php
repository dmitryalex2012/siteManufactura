<?php

namespace app\services;

use app\models\Services;

class ServicesServices
{
    /**
     * Find information about our services
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getOurServices()
    {
        return Services::findOurServices();
    }
}