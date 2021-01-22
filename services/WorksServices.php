<?php

namespace app\services;

use app\models\Works;
use yii\base\InvalidConfigException;

class WorksServices
{
    /**
     * Get information about our works
     *
     * @return mixed
     * @throws InvalidConfigException
     */
    public static function getOurWorks ()
    {
        return Works::findOurWorks();
    }
}