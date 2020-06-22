<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Cart extends ActiveRecord
{
    public function totalQuantity () {             //  determination total products amount in cart
        $totalQuantity = 0;

        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $cart = [];
        } else {
            $cart = $session->get('cart');
        }
        $session->close();

        foreach ($cart as $numberProduct=>$table) {
            foreach ($table as $item=>$value1) {
                if ($item == "quantity") {
                    $totalQuantity = $totalQuantity + $value1;
                }
            }
        }
        return $totalQuantity;
    }

    public function addToCart ($number)
    {
        $product = Products::find()->where(['number' => $number])->one();   // $product - array

        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $cart ["delivery"]["deliveryType"] = "выберите удобный Вам тип доставки";
            $cart ["purchase"]["purchaseType"] = "выберите удобный Вам способ оплаты";
        } else {
            $cart = $session->get('cart');
        }
// **************************************  Associative array $cart structure: ***************************************************
//      $cart {                                                                                                                 *
//            $number=>array("number"=>$number, "title"=>$title, "content"=>$content, "quantity"=>$quantity, "price"=>$price),  *
//            $number=>array("number"=>$number, "title"=>$title, "content"=>$content, "quantity"=>$quantity, "price"=>$price),  *
//                          .                                                                                                   *
//                          .                                                                                                   *
//            $number=>array("number"=>$number, "title"=>$title, "content"=>$content, "quantity"=>$quantity, "price"=>$price),  *
//            "delivery"=>array("deliveryType"=>$deliveryType),                                                                  *
//            "purchase"=>array("purchaseType"=>$purchaseType)                                                                   *
//      }                                                                                                                       *
//*******************************************************************************************************************************
        $quantity = 1;
        if (isset($cart[$number])) {
            $quantity = ++$cart[$number]['quantity'];
        }
        if ($quantity > 10) {                           // products in Cart should be < 10
            $quantity = 10;
        }

        $cart[$number]["number"] = $number;
        $cart[$number]["title"] = $product["title"] ;
        $cart[$number]["content"] = $product["content"] ;
        $cart[$number]["quantity"] = $quantity;
        $cart[$number]["price"] = $product["price"];

        $session->set('cart', $cart);                   // write $product in SESSION
        $session->close();
        return;
    }

    public function outFromCart () {                    // take all products from Cart for output
        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $cart = [];
        } else {
            $cart = $session->get('cart');
        }
        $session->close();
        return $cart;
    }

    public function changeCart ($number, $quantity) {       // change product quantity in Cart
        $price = $difference = 0;
        $session = Yii::$app->session;
        $session->open();
        if ($session)
        {
            $cart = $session->get('cart');
            $oldPrice = $cart[$number]["quantity"] * $cart[$number]["price"];
            $cart[$number]["quantity"] = $quantity;
            $session->set('cart', $cart);

            $price = $cart[$number]["quantity"] * $cart[$number]["price"];
            $difference = $price - $oldPrice;               // "difference" using for determination NEW total price in "cartList" view
        }
        $session->close();
        $resultChange = array("0" => $price, "1" => $difference);

        return $resultChange;
    }

    public function clearCart () {              // Delete Cart from SESSION
        $session = Yii::$app->session;
        $session->open();
        if ($session) {
            Yii::$app->session->destroy();
        }
        $session->close();
        return;
    }

    public function changeDelivery ($deliveryType) {    // change delivery type
        $session = Yii::$app->session;
        $session->open();
        if ($session->has('cart')) {
            $cart = $session->get('cart');
            $cart ["delivery"]["deliveryType"] = $deliveryType;
        }
          else { $cart ["delivery"]["deliveryType"] = "Новая почта"; }
        $session->set('cart', $cart);                   // write delivery type in SESSION
        $session->close();

        return $deliveryType;
    }

    public function changePurchase ($purchaseType) {    // change purchase type
        $session = Yii::$app->session;
        $session->open();
        if ($session->has('cart')) {
            $cart = $session->get('cart');
            $cart ["purchase"]["purchaseType"] = $purchaseType;
        }
        else { $cart ["purchase"]["purchaseType"] = "Наложным платежом"; }
        $session->set('cart', $cart);                   // write delivery type in SESSION
        $session->close();

        return $purchaseType;
    }

    public function promoCode ($promoCode)
    {             // add promo code
        $session = Yii::$app->session;
        $session->open();
        $cart = $session->get('cart');
        $cart ["promoCode"]["discount"] = $promoCode;
        $session->set('cart', $cart);
        $session->close();
    }
}