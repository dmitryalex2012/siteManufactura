<?php

namespace app\models;

use yii\db\ActiveRecord;

class Works extends ActiveRecord
{
    /**
     * Find our works list in DB
     *
     * @return array|ActiveRecord[]
     */
    public static function findOurWorks()
    {
        return Works::find()->all();
    }
}