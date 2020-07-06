<?php

namespace app\services;

use app\models\Products;
//use yii\web\Session;
//use yii\db\ActiveRecord;
use Yii;

class CartService
{
    public function addToCart($productID)
    {
        $product = Products::findByNumber($productID);

        $session = Yii::$app->session;
        $session->open();

        $cart = $this->getCart($session);


    }

    private function getCart($session)
    {
        if ($session->has('cart')) {
            return $session->get('cart');
        }

        return [
            'delivery' => ['deliveryType' => 'выберите удобный Вам тип доставки'],
            'purchase' => ['purchaseType' => 'выберите удобный Вам способ оплаты']
        ];
    }
}