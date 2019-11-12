<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use Yii;

class Cart extends Model
{
    public function addToCart ($number) {

        $product = Products::find()->where(['number' => $number])->one();
//        $id = Yii::$app->$product->id;
//        $id = $this->$product->id;
//        $array = (array) $product;





        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $session->set('cart',[]);
            $cart = [];
        } else {
            $cart = $session->get('cart');
        }

        if(isset($cart['number'][$number])) {
            $count = $cart[$id]["count"] + 1;
            if ($count>10){
                $count = 10;
            }
            $cart[$id]['count'] = $count;
        } else {
            $cart[$id]['count'] = 1;
        }

        $session->set('cart', $cart);       // write $product in SESSION
        $session->close();

        return $cart;
    }

    public function outFromCart () {
        $session = Yii::$app->session;
        $session->open();
        if (isset($session['cart'])) {
            $cart = $session->get('cart');
        } else {
            $cart = [];
        }
        $session->close();
        return;
//        return $this->$cart;
    }

}