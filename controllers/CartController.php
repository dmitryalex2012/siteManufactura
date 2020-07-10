<?php

namespace app\controllers;

use app\models\CustomerForm;
use yii\web\Controller;
use Yii;
use app\services\CartService;
use yii\web\Response;


class CartController extends Controller
{
    private $cartService;
    private $model;

    public function __construct($id, $module, $config = [])
    {
        $this->cartService = new CartService();

        $this->model = new CustomerForm();

        parent::__construct($id, $module, $config);
    }


    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        $totalQuantity = $this->cartService->getTotalQuantity();
        $this->cartService->cartCapacityTest($totalQuantity);

        if ($this->model->load(Yii::$app->request->post()) && $this->model->contact(Yii::$app->params['adminEmail'])) { // When "Html::submitButton" was pressed
            Yii::$app->session->addFlash('customerMessage', 'contactFormSubmitted');  // Set marker "contactFormSubmitted" in $customerMessage[1]
            return $this->refresh();                                                            //    means: message to customer is sent.
        }

        return $this->render('cartList', [
            'cart' => $this->cartService->getProductsFromCart(),
            'totalQuantity' => $totalQuantity,
            'model' => $this->model                                           // object in ActiveForm (for email sending)
        ]);
    }


    /**
     * Add product to Cart
     *
     * @return int
     */
    public function actionAdd()
    {
        $productNumber = Yii::$app->request->post('productID');

        return $this->cartService->addToCart($productNumber);
    }


    /**
     * Change quantity products from "Cart" Page
     *
     * @return array|false|string
     */

    public function actionChange()
    {
        $productData = Yii::$app->request->post('productData');

        return $this->cartService->changeQuantityProducts($productData);


    }
    /**
     * Determination total products quantity in cart.
     * The total products quantity outputs near inscription "Cart" in layout.
     *
     * @return int
     */
    public function actionTotal()
    {
        return $this->cartService->getTotalQuantity();
    }

    /**
     * Save delivery type in session
     *
     * @return mixed
     */
    public function actionDelivery()
    {
        $deliveryType = Yii::$app->request->post('deliveryTypeJS');

        return $this->cartService->changeDelivery($deliveryType);
    }


    /**
     * Save purchase type in session
     *
     * @return mixed
     */
    public function actionPurchase()
    {
        $purchaseType = Yii::$app->request->post('purchaseTypeJS');

        return $this->cartService->changePurchase($purchaseType);
    }


    /**
     * Testing promo code authenticity and change product price when promo code is entered correct.
     *
     * @return float|int
     */
    public function actionPromocode()
    {
        $promoCode = Yii::$app->request->post('promoCodeJS');

        return $this->cartService->checkPromoCode($promoCode);
    }
}
