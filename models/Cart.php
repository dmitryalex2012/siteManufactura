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
        } else {
            $cart = $session->get('cart');
        }
        // write $product in SESSION


        $session->close();

        return;
    }
}