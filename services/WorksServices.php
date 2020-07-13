<?php

namespace app\services;

use app\models\Works;

class WorksServices
{
    /**
     * Get list of our works list
     *
     * @return mixed
     */
    public function getOurWorks ()
    {
        return Works::findOurWorks();
    }
}