<?php

namespace app\controllers;

use app\models\Cart;
use app\models\CustomerForm;
use yii\web\Controller;
use Yii;
use app\common\components\MyHelpers;


class CartController extends Controller
{
    public function actionIndex()
    {
        $cart = new Cart();
        $totalQuantity = $cart->totalQuantity();
        if ($totalQuantity == 0) { $cart->clearCart(); }

        $model = new CustomerForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) { // When "Html::submitButton" was pressed
            Yii::$app->session->setFlash('contactFormSubmitted');       // Set marker "contactFormSubmitted", that means:
            return $this->refresh();                                        //   message sent.
        }

        return $this->render('cartList', [
            'cart' => $cart->outFromCart(),
            'totalQuantity' => $totalQuantity,
            'model' => $model
        ]);
    }

    public function actionAdd()
    {
            $cart = new Cart();
            $productNumber = Yii::$app->request->post('productID');
            $cart->addToCart($productNumber);
            $totalQuantity = $cart->totalQuantity();

            return $totalQuantity;
    }

    public function actionChange()
    {
        $productsEnding = new MyHelpers();
        $cart = new Cart();

        $data = Yii::$app->request->post('productData'); // productData = product ID *** product quantity
        $data = explode("***", $data);
        $id = $data[0];
        $quantity = $data[1];
        $resultChange = $cart->changeCart($id, $quantity);     // new quantity to DB

        $resultChange[2] = $cart->totalQuantity();
        $resultChange[3] = $productsEnding->productsEnding($resultChange[2]);
        $resultChange = json_encode($resultChange);            // AJAX use JSON data, because convert result in JSON format
// **********************************************************************
// $resultChange {                                                      *
//                "0" : product price,                                  *
//                "1" : difference between old and new prices,          *
//                "2" : total quantity of products,                     *
//                "3" : ending of the product (товар, товарА, товарОВ)  *
//               }                                                      *
//***********************************************************************
        return $resultChange;
    }

    public function actionTotal()
    {
        $cart = new Cart();
        $totalQuantity = $cart->totalQuantity();

        return $totalQuantity;
    }

    public function actionDelivery()           // save delivery type in DB
    {
        $cart = new Cart();

        return $cart->changeDelivery(Yii::$app->request->post('deliveryTypeJS'));
    }

    public function actionPurchase()
    {
        $cart = new Cart();

        return $cart->changePurchase(Yii::$app->request->post('purchaseTypeJS'));
    }

}
