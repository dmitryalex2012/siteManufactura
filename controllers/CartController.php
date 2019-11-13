<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Products;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\helpers\Url;
use Yii;

class CartController extends Controller
{
//    public function actionList()
//    {
//        $items = Works::find()->where(['id'=>1]);
//
//        $items = Works::find()->all();
//
//        $items = Works::find()->asArray()->all();
//
//        return $this->render('list', [
//            'countTotal' => 6000000000,
//            'title' => 'My page of world people',
//            'items' => $items
//        ]);
//    }
//}

    public function actionIndex()
    {
        $pillows = Cart::find()->all();
        $cart = new Cart();
        $myTemp = $cart->outFromCart();

        return $this->render('cartList', [
            'items' => $pillows,
            'myTemp' => $myTemp,
        ]);
    }

    public function actionAdd()
    {
        if ((Yii::$app->request->isAjax)) {
            $cart = new Cart();
            $productNumber = Yii::$app->request->post('productID');
            $temp = $cart->addToCart($productNumber);

            return;
        }

        return;
    }

    public function actionTempadd()
    {
        $cart = new Cart();
        $productNumber = 1002;
        $temp = $cart->addToCart($productNumber);

        return $this->render('temp', [
            'temp' => $temp
        ]);
    }

    public function actionTempout()
    {
        $cart = new Cart();
        $temp = $cart->outFromCart();

        return $this->render('temp', [
            'temp' => $temp
        ]);
    }

}