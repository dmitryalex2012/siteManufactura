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
        $totalQuantity = $cart->totalQuantity();

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
        $cart = new Cart();

        $data = Yii::$app->request->post('productData');
        $data = explode("***", $data);
        $id = $data[0];
        $quantity = $data[1];
        $jjj = $cart->changeCart($id, $quantity);

//        $arr1 = array("0"=>0, "1"=>1, "2"=>2);
//        $jarr = json_encode($arr1);
        return $jjj;

//        $cart = new Cart();
//        $temp = $cart->outFromCart();

//        return $this->render('temp', [
//            'temp' => $temp
//        ]);
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
