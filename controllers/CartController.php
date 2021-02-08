<?php

namespace app\controllers;

use app\models\CustomerForm;
use yii\web\Controller;
use Yii;
use app\services\CartServices;
use yii\web\Response;


class CartController extends Controller
{
    private $cartService;
    private $model;

    public function __construct($id, $module, $config = [])
    {
        $this->cartService = new CartServices();

        $this->model = new CustomerForm();

        parent::__construct($id, $module, $config);
    }


    /**
     * Loads data from Form if it fields are filled.
     * Returns page for view.
     *
     * @return string|Response
     */
    public function actionIndex()
    {
        if ($this->model->load(Yii::$app->request->post()) && $this->model->contact(Yii::$app->params['adminEmail'])) { // When "Html::submitButton" was pressed
            Yii::$app->session->addFlash('customerMessage', 'contactFormSubmitted');  // Set marker "contactFormSubmitted" in $customerMessage[1]
            return $this->refresh();                                                            //    means: message to customer is sent.
        }

        $totalQuantity = $this->cartService->getTotalQuantity();
        $this->cartService->cartCapacityTest($totalQuantity);
        $cart = $this->cartService->getProductsFromCart();

        return $this->render('cartList', [
            'cart' => $cart,
            'totalQuantity' => $totalQuantity,
            'model' => $this->model                                           // object in ActiveForm (for email sending)
        ]);
    }


    /**
     * Adds product to Cart
     *
     * @return int
     */
    public function actionAdd()
    {
        $productNumber = Yii::$app->request->post('productID');

        return $this->cartService->addToCart($productNumber);
    }


    /**
     * Changes quantity products from "Cart" page
     *
     * @return array|false|string
     */
    public function actionChange()
    {
        $productData = Yii::$app->request->post('productData');

        return $this->cartService->changeQuantityProducts($productData);
    }


    /**
     * Determinations total products quantity in cart.
     * The total products quantity outputs near inscription "Cart" in layout.
     *
     * @return int
     */
    public function actionTotal()
    {
        return $this->cartService->getTotalQuantity();
    }


    /**
     * Saves delivery type in session
     *
     * @return mixed
     */
    public function actionDelivery()
    {
        $deliveryType = Yii::$app->request->post('deliveryTypeJS');

        return $this->cartService->changeDelivery($deliveryType);
    }


    /**
     * Saves purchase type in session
     *
     * @return mixed
     */
    public function actionPurchase()
    {
        $purchaseType = Yii::$app->request->post('purchaseTypeJS');

        return $this->cartService->changePurchase($purchaseType);
    }


    /**
     * Tests promo code authenticity and changes product price when promo code is entered correct.
     *
     * @return float|int
     */
    public function actionPromocode()
    {
        $promoCode = Yii::$app->request->post('promoCodeJS');

        return $this->cartService->checkPromoCode($promoCode);
    }
}
