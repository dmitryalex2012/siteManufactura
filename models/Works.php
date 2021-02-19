<?php

namespace app\models;

use yii\db\ActiveRecord;

class Works extends ActiveRecord
{
    /**
     * Find information in DB about our works
     *
     * @return array|ActiveRecord[]
     */
    public static function findOurWorks()
    {
        return Works::find()->all();
    }
}