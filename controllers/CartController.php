<?php

namespace app\controllers;

use app\models\Cart;
use app\models\CustomerForm;
use yii\web\Controller;
use Yii;
use app\common\components\MyHelpers;

use app\services\CartService;
use yii\web\Response;


class CartController extends Controller
{
    private $cartService;
    private $cart;
    private $model;

    public function __construct($id, $module, $config = [])
    {
        $this->cartService = new CartService();
        $this->cart = new Cart();
        $this->model = new CustomerForm();
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        $totalQuantity = $this->cart->totalQuantity();
        $this->cartService->cartCapacityTest($totalQuantity);

        if ($this->model->load(Yii::$app->request->post()) && $this->model->contact(Yii::$app->params['adminEmail'])) { // When "Html::submitButton" was pressed
            Yii::$app->session->addFlash('customerMessage', 'contactFormSubmitted');  // Set marker "contactFormSubmitted" in $customerMessage[1]
            return $this->refresh();                                                            //    means: message to customer is sent.
        }

        return $this->render('cartList', [
            'cart' => $this->cart->outFromCart(),
            'totalQuantity' => $totalQuantity,
            'model' => $this->model                                           // object in ActiveForm (for email sending)
        ]);
    }

    public function actionAdd()         // add product to Cart
    {
//            $cart = new Cart();
//            $productNumber = Yii::$app->request->post('productID');
//            $cart->addToCart($productNumber);
//            $totalQuantity = $cart->totalQuantity();
//
//            return $totalQuantity;

        $productNumber = Yii::$app->request->post('productID');

        return $this->cartService->addToCart($productNumber);
    }

    public function actionChange()          // change quantity products from Cart Page
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

    public function actionTotal()       // Using for determination total quantity products and it
    {                                   //   out near inscription "Cart" in Layout
        return $this->cart->totalQuantity();
    }

    public function actionDelivery()           // save delivery type in DB
    {
        return $this->cart->changeDelivery(Yii::$app->request->post('deliveryTypeJS'));
    }

    public function actionPurchase()           // save purchase type in DB
    {
        $purchaseType = Yii::$app->request->post('purchaseTypeJS');

        return $this->cartService->changePurchase($purchaseType);
    }

    /**
     * Testing promo code authenticity
     *
     * @return float|int
     */
    public function actionPromocode()             // change product price when promo code is entered
    {
        $promoCode = Yii::$app->request->post('promoCodeJS');

        return $this->cartService->checkPromoCode($promoCode);
    }
}
