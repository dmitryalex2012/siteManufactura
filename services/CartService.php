<?php

namespace app\services;

use app\models\Products;
use yii\db\ActiveRecord;
use yii\web\Session;
use Yii;

class CartService
{
    /**
     * @param $productID
     */
    public function addToCart($productID)
    {
        $product = Products::findByNumber($productID);

        $session = Yii::$app->session;
        $session->open();

        $cart = $this->getCart($session);
        $cart = $this->addProductToCart($product, $cart);

        $session->set('cart', $cart);                   // write $product in SESSION
        $session->close();

        return $this->getTotalQuantity();
    }

    /**
     * @param Session $session
     *
     * @return array|mixed
     */
    private function getCart(Session $session)
    {
        if ($session->has('cart')) {
            return $session->get('cart');
        }

        return [
            'delivery' => ['deliveryType' => 'выберите удобный Вам тип доставки'],
            'purchase' => ['purchaseType' => 'выберите удобный Вам способ оплаты']
        ];
    }

    /**
     * @param ActiveRecord $product
     *
     * @param array $cart
     *
     * @return array
     */
    // **************************************  Associative array $cart structure: ***************************************************
//      $cart {                                                                                                                 *
//            $number=>array("number"=>$number, "title"=>$title, "content"=>$content, "quantity"=>$quantity, "price"=>$price),  *
//            $number=>array("number"=>$number, "title"=>$title, "content"=>$content, "quantity"=>$quantity, "price"=>$price),  *
//                          .                                                                                                   *
//                          .                                                                                                   *
//            $number=>array("number"=>$number, "title"=>$title, "content"=>$content, "quantity"=>$quantity, "price"=>$price),  *
//            "delivery"=>array("deliveryType"=>$deliveryType),                                                                 *
//            "purchase"=>array("purchaseType"=>$purchaseType)                                                                  *
//            "promoCode"=>array("discount"=>$promoCode)         // add in "promoCode" method                                   *
//      }                                                                                                                       *
//*******************************************************************************************************************************
    private function addProductToCart(ActiveRecord $product, array $cart)
    {
        $productNumber = $product->number;
        if (isset($cart[$productNumber])) {
            if ($cart[$productNumber]['quantity'] < 10){
                $cart[$productNumber]['quantity']++;
            }

            return $cart;
        }

        $cart[$productNumber]['number'] = $productNumber;
        $cart[$productNumber]['title'] = $product['title'] ;
        $cart[$productNumber]['content'] = $product['content'] ;
        $cart[$productNumber]['price'] = $product['price'];
        $cart[$productNumber]['quantity'] = 1;

        return $cart;
    }

    public function getTotalQuantity ()
    {   //  determination total products amount in cart

        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $cart = [];
        } else {
            $cart = $session->get('cart');
        }
        $session->close();

        $totalQuantity = 0;
        foreach ($cart as $product) {
            if ($product['quantity']) {
                $totalQuantity += $product['quantity'];
            }
        }

        return $totalQuantity;
    }
}