<?php

namespace app\models;

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

            $cart = $product;

        } else {
            $cart = $session->get('cart');
        }
        if(in_array($cart[]))
//        foreach ($cart as $key=>$item) {
//            if (($key==='number') && ($item===$number)) {
//                foreach ($cart as $key1=>$item1) {
//                    if (($key==='number') && ($item===$number)) {
//
//                    }
//                }
//            }
//        }
        // write $product in SESSION

        $session->set('cart', $cart);
        $session->close();

        return;
    }
}