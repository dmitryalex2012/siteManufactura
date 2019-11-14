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

// WRITE products (object - table) STRUCTURE AS COMMENT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        $cart[$number]["number"] = $number;
        $cart[$number]["title"] = $product->title ;
        $cart[$number]["count"] = 1;
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
            $cart = "empty";
        } else {
            $cart = $session->get('cart');
        }
        $session->close();
        return $cart;
    }

}