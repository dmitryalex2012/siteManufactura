<?php

namespace app\services;

use app\models\Products;

class ProductServices
{
    /**
     * Get list of products by specified category
     *
     * @param $category
     *
     * @return array
     */
    public function getProductsByCategory ($category)
    {
        return Products::findByCategory($category);
    }


    /**
     * Get product by ID
     *
     * @param $productID
     *
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getProductByNumber($productID)
    {
        return Products::findByNumber($productID);
    }
}