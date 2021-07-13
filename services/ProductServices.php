<?php

namespace app\services;

use app\models\Products;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class ProductServices
{
    /**
     * Get list of products by specified category
     *
     * @param $category
     *
     * @return array
     * @throws InvalidConfigException
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
     * @return array|ActiveRecord|null
     * @throws InvalidConfigException
     */
    public function getProductByNumber($productID)
    {
        return Products::findByNumber($productID)->toArray();
    }

    /**
     * Determines the photo addresses of the selected product.
     * The photo addresses is separated by the ",".
     *
     * @param $product
     * @return array|ActiveRecord|null
     */
    public function getProductPhotos($product)
    {
        /** Is presented ONE photo of product in DB or MORE? */
        if (strpos($product['address'], ',') == true){
            /** >1 photo. Make array with products photos addresses. */
            $product['photoURL'] = explode(",", $product['address']);
            $product['photoQuantity'] = count($product['photoAddress']);
        } else{
            /** 1 photo */
            $product['photoQuantity'] = 1;
            $product['photoURL'] = $product['address'];
        }

        return $product;
    }
}