<?php

namespace app\models;

use yii\db\ActiveRecord;

class Products extends ActiveRecord
{
    /**
     * Find all products from specified category
     *
     * @param $category
     *
     * @return array|ActiveRecord[]
     */
    public static function findByCategory($category)
    {
        return static::find()->where(['categories' => $category])->all();
    }

    /**
     * Find product in DB by ID
     *
     * @param $productID
     *
     * @return array|ActiveRecord|null
     */
    public static function findByNumber($productID)
    {
        return $product = Products::find()->where(['number' => $productID])->one();
    }

}