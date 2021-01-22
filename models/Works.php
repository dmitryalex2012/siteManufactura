<?php

namespace app\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class Works extends ActiveRecord
{
    /**
     * Find information in DB about our works
     *
     * @return array|ActiveRecord[]
     * @throws InvalidConfigException
     */
    public static function findOurWorks()
    {
        return Works::find()->all();
    }
}