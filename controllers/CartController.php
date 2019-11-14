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
        $cart = new Cart();

        return $this->render('cartList', [
            'items' => $cart->outFromCart()
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

    public function actionOut()
    {
        $cart = new Cart();
        $temp = $cart->outFromCart();

        return $this->render('temp', [
            'temp' => $temp
        ]);
    }

}