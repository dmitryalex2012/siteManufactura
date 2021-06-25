<?php

namespace app\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class Products extends ActiveRecord
{
    /**
     * Find all products from specified category
     *
     * @param $category
     * @return array|ActiveRecord[]
     * @throws InvalidConfigException
     */
    public static function findByCategory($category)
    {
        return static::find()->where(['categories' => $category])->all();
    }

    /**
     * Find product in DB by ID
     *
     * @param $productID
     * @return array|ActiveRecord|null
     * @throws InvalidConfigException
     */
    public static function findByNumber($productID)
    {
        return static::find()->where(['number' => $productID])->one();
    }
}