<?php

namespace app\services;

use app\models\Products;
use yii\db\ActiveRecord;
use yii\web\Session;
use Yii;

class CartService
{
    /**
     * Adding chosen product in cart (cart - in session)
     *
     * @param $productID
     *
     * @return int
     */
    public function addToCart($productID)
    {
        $product = Products::findByNumber($productID);

        $session = Yii::$app->session;
        $session->open();

        $cart = $this->getCart($session);
        $cart = $this->addProductToCart($product, $cart, $productID);

        $session->set('cart', $cart);
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
     * @param $productID
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
//            "promoCode"=>array("discount"=>$promoCode)                // add in "promoCode" method                            *
//      }                                                                                                                       *
//*******************************************************************************************************************************
    private function addProductToCart(ActiveRecord $product, array $cart, $productID)
    {
//        $productNumber = $product->number;
        if (isset($cart[$productID])) {
            if ($cart[$productID]['quantity'] < 10){
                $cart[$productID]['quantity']++;
            }

            return $cart;
        }

        $cart[$productID]['number'] = $productID;
        $cart[$productID]['title'] = $product['title'] ;
        $cart[$productID]['content'] = $product['content'] ;
        $cart[$productID]['price'] = $product['price'];
        $cart[$productID]['quantity'] = 1;

        return $cart;
    }

    /**
     * Determination total products amount in cart
     *
     * @return int
     */
    public function getTotalQuantity ()
    {

        $session = Yii::$app->session;
        $session->open();
//        if (!$session->has('cart')) {
//            $cart = [];
//        } else {
//            $cart = $session->get('cart');
//        }
        $cart = $session->get('cart');
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