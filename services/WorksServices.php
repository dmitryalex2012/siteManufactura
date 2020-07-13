<?php

namespace app\services;

use app\models\Works;

class WorksServices
{
    /**
     * Get information about our works
     *
     * @return mixed
     */
    public static function getOurWorks ()
    {
        return Works::findOurWorks();
    }
}