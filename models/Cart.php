<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use Yii;

class Cart extends ActiveRecord
{
    public function addToCart ($number) {

        $product = Products::find()->where(['number' => $number])->one();       // $product - OBJECT

        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $session->set('cart',[]);
            $cart = [];                             // $cart - ARRAY
        } else {
            $cart = $session->get('cart');
        }
//  Associative array $cart structure:
//      $cart {
//            $number=>array("number"=>$number, "title"=>$title, "quantity"=>$quantity, "price"=>$price),
//            $number=>array("number"=>$number, "title"=>$title, "quantity"=>$quantity, "price"=>$price),
//                          .
//                          .
//            $number=>array("number"=>$number, "title"=>$title, "quantity"=>$quantity, "price"=>$price)
//      }
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
        return $cart;
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
        $price = 0;
        $session = Yii::$app->session;
        $session->open();
        if ($session) {
            $cart = $session->get('cart');
            $cart[$number]["quantity"] = $quantity;
            $session->set('cart', $cart);
            $price = $cart[$number]["quantity"] * $cart[$number]["price"];
        }
        $session->close();
        return $price;
    }

}