<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use Yii;

class Cart extends ActiveRecord
{
    public function addToCart ($number) {

        $product = Products::find()->where(['number' => $number])->one();

        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $session->set('cart',[]);
            $cart = [];
        } else {
            $cart = $session->get('cart');
        }
//  Associative array $cart structure:
//      $cart {
//            $number=>array("number"=>$number, "title"=>$title, "count"=>$count, "amount"=>$amount),
//            $number=>array("number"=>$number, "title"=>$title, "count"=>$count, "amount"=>$amount),
//                          .
//                          .
//            $number=>array("number"=>$number, "title"=>$title, "count"=>$count, "amount"=>$amount)
//      }
        $count = 1;
        if (isset($cart[$number])) {
            $count = ++$cart[$number]['count'];
        }
        if ($count > 10) {
            $count = 10;
        }

        $cart[$number]["number"] = $number;
        $cart[$number]["title"] = $product->title ;
        $cart[$number]["count"] = $count;
        $cart[$number]["amount"] = $product->price;
//        $product = (array) $product;
//        $cart = $product->number;


//        if(isset($cart['number'][$number])) {
//            $count = $cart[$id]["count"] + 1;
//            if ($count>10){
//                $count = 10;
//            }
//            $cart[$id]['count'] = $count;
//        } else {
//            $cart[$id]['count'] = 1;
//        }


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

}