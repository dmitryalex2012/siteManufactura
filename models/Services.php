<?php

namespace app\models;

use yii\db\ActiveRecord;

class Services extends ActiveRecord
{
    /**
     * Find information in DB about our services
     *
     * @return array|ActiveRecord[]
     */
    public static function findOurServices()
    {
        return Services::find()->all();
    }
}