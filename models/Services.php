<?php

namespace app\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class Services extends ActiveRecord
{
    /**
     * Find information in DB about our services
     *
     * @return array|ActiveRecord[]
     * @throws InvalidConfigException
     */
    public static function findOurServices()
    {
        return Services::find()->all();
    }
}