<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use Yii;

class Cart extends ActiveRecord
{
    public function totalQuantity () {
        $totalQuantity = 0;             //  take total amount in cart

        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $cart = [];         // ??????????????????????????????
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

    public function addToCart ($number) {

        $product = Products::find()->where(['number' => $number])->one();       // $product - OBJECT

        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $session->set('cart',[]);
//            $cart = [];                             // $cart - ARRAY
            $cart ["delivery"]["deliveryType"] = "выберите удобный Вам тип доставки";
            $cart ["purchase"]["purchaseType"] = "выберите удобный Вам способ оплаты";
        } else {
            $cart = $session->get('cart');
        }
// ************************  Associative array $cart structure: *********************************************
//      $cart {                                                                                             *
//            $number=>array("number"=>$number, "title"=>$title, "quantity"=>$quantity, "price"=>$price),   *
//            $number=>array("number"=>$number, "title"=>$title, "quantity"=>$quantity, "price"=>$price),   *
//                          .                                                                               *
//                          .                                                                               *
//            $number=>array("number"=>$number, "title"=>$title, "quantity"=>$quantity, "price"=>$price),   *
//            $delivery=>array("deliveryType"=>$deliveryType)                                           *
//      }                                                                                                   *
//***********************************************************************************************************
        //count
        $quantity = 1;
        if (isset($cart[$number])) {
            $quantity = ++$cart[$number]['quantity'];
        }
        if ($quantity > 10) {
            $quantity = 10;
        }

        $cart[$number]["number"] = $number;
        $cart[$number]["title"] = $product->title ;     // title - PROPERTY of the $product OBJECT
        $cart[$number]["quantity"] = $quantity;
        $cart[$number]["price"] = $product->price;

        $session->set('cart', $cart);       // write $product in SESSION
        $session->close();
//        return $cart;
        return;
    }

    public function outFromCart () {
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

    public function changeCart ($number, $quantity) {
        $price = $difference = 0;
        $session = Yii::$app->session;
        $session->open();
        if ($session) {
            $cart = $session->get('cart');
            $oldQuantity = $cart[$number]["quantity"];
            $oldPrice = $cart[$number]["quantity"] * $cart[$number]["price"];
            $cart[$number]["quantity"] = $quantity;
            $session->set('cart', $cart);
            $price = $cart[$number]["quantity"] * $cart[$number]["price"];

            $difference = $price - $oldPrice;
        }
        $session->close();
        $resultChange = json_encode(array("0"=>$price, "1"=>$difference));

        return $resultChange;
    }

    public function clearCart () {
        $session = Yii::$app->session;
        $session->open();
        if ($session) {
            Yii::$app->session->destroy();
        }
        $session->close();
        return;
    }

    public function changeDelivery ($deliveryType) {
        $session = Yii::$app->session;
        $session->open();
        if ($session->has('cart')) {
            $cart = $session->get('cart');
            $cart ["delivery"]["deliveryType"] = $deliveryType;
        }
          else { $cart ["delivery"]["deliveryType"] = "Новая почта"; }     // need delete
        $session->set('cart', $cart);       // write delivery type in SESSION
        $session->close();

        return $deliveryType;
    }

    public function changePurchase ($purchaseType) {
        $session = Yii::$app->session;
        $session->open();
        if ($session->has('cart')) {
            $cart = $session->get('cart');
            $cart ["purchase"]["purchaseType"] = $purchaseType;
        }
        else { $cart ["purchase"]["purchaseType"] = "Наложным платежом"; }     // need delete
        $session->set('cart', $cart);       // write delivery type in SESSION
        $session->close();

        return $purchaseType;
    }

}