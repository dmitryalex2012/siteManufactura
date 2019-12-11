<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Products;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\helpers\Url;
use Yii;
use app\common\components\MyHelpers;


class CartController extends Controller
{
    public function actionIndex()
    {
        $cart = new Cart();
        $totalQuantity = $cart->totalQuantity();
        if ($totalQuantity == 0) { $cart->clearCart(); }

        return $this->render('cartList', [
            'items' => $cart->outFromCart(),
            'totalQuantity' => $totalQuantity
        ]);
    }

    public function actionAdd()
    {
        if ((Yii::$app->request->isAjax)) {
            $cart = new Cart();
            $productNumber = Yii::$app->request->post('productID');
//            $temp = $cart->addToCart($productNumber);
            $cart->addToCart($productNumber);
            $totalQuantity = $cart->totalQuantity();

            return $totalQuantity;
        }
        return;
    }

    public function actionChange()     // not write completely yet
    {
        $productsEnding = new MyHelpers();
        $cart = new Cart();

        $data = Yii::$app->request->post('productData');
        $data = explode("***", $data);
        $id = $data[0];
        $quantity = $data[1];
        $resultChange = $cart->changeCart($id, $quantity);

        $resultChange = json_decode($resultChange);
        $resultChange[2] = $cart->totalQuantity();
        $resultChange[3] = $productsEnding->productsEnding($resultChange[2]);;
        $resultChange = json_encode($resultChange);

        return $resultChange;
    }

    public function actionTotal()
    {
        $cart = new Cart();
        $totalQuantity = $cart->totalQuantity();

        return $totalQuantity;
    }

//    public function actionTemp()
//    {
//
//        $cart = new Cart();
//        $totalQuantity = $cart->temp();
//
//        return $totalQuantity;
//    }

}
