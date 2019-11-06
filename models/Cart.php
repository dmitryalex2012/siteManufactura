<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Cart extends ActiveRecord
{
    public function addToCart ($number) {

        $product = Products::find()->where(['number' => $number])->one();
        $id = Yii::$app->$product->id;

        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $session->set('cart',[]);
            $cart = [];
        } else {
            $cart = $session->get('cart');
        }

        if(isset($cart["number"][$number])) {
            $count = $cart[$id]["count"] + 1;
            if ($count>10){
                $count = 10;
            }
            $cart[$id]['count'] = $count;
        } else {
            $cart[$id]['count'] = 1;
        }

        // write $product in SESSION
        $session->set('cart', $cart);
        $session->close();

        return;
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