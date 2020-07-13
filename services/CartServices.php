<?php

namespace app\services;

use app\common\components\MyHelpers;
use app\models\Products;
use yii\db\ActiveRecord;
use yii\web\Session;
use Yii;

class CartServices
{
    /**
     * Adding chosen product in cart (cart - in session)
     *
     * @param $productID
     *
     * @return int
     */
    public function addToCart($productID)
    {
        $product = Products::findByNumber($productID);

        $session = Yii::$app->session;
        $session->open();

        $cart = $this->getCart($session);
        $cart = $this->addProductToCart($product, $cart, $productID);

        $session->set('cart', $cart);
        $session->close();

        return $this->getTotalQuantity();
    }


    /**
     * @param Session $session
     *
     * @return array|mixed
     */
    public function getCart(Session $session)
    {
        if ($session->has('cart')) {
            return $session->get('cart');
        }

        return [
            'delivery' => ['deliveryType' => 'выберите удобный Вам тип доставки'],
            'purchase' => ['purchaseType' => 'выберите удобный Вам способ оплаты']
        ];
    }


    /**
     * @param ActiveRecord $product
     *
     * @param array $cart
     *
     * @param $productID
     *
     * @return array
     */
// **************************************  Associative array $cart structure: ***************************************************
//      $cart {                                                                                                                 *
//            $number=>array("number"=>$number, "title"=>$title, "content"=>$content, "quantity"=>$quantity, "price"=>$price),  *
//            $number=>array("number"=>$number, "title"=>$title, "content"=>$content, "quantity"=>$quantity, "price"=>$price),  *
//                          .                                                                                                   *
//                          .                                                                                                   *
//            $number=>array("number"=>$number, "title"=>$title, "content"=>$content, "quantity"=>$quantity, "price"=>$price),  *
//            "delivery"=>array("deliveryType"=>$deliveryType),                                                                 *
//            "purchase"=>array("purchaseType"=>$purchaseType)                                                                  *
//            "promoCode"=>array("discount"=>$promoCode)                // add in "promoCode" method                            *
//      }                                                                                                                       *
//*******************************************************************************************************************************
    private function addProductToCart(ActiveRecord $product, array $cart, $productID)
    {
        if (isset($cart[$productID])) {
            if ($cart[$productID]['quantity'] < 10){
                $cart[$productID]['quantity']++;
            }

            return $cart;
        }

        $cart[$productID] = $product->toArray();
        $cart[$productID]['quantity'] = 1;

        return $cart;
    }


    /**
     * Take all products from Cart for output
     *
     * @return array|mixed
     */
    public function getProductsFromCart()
    {
        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $cart = [];
        } else {
            $cart = $session->get('cart');
        }
        $session->close();

        return $cart;
    }


    /**
     * Change quantity products (performs from Cart Page)
     *
     * @param $productData
     *
     * @return array|false|string
     */
// **********************************************************************
// $resultChange {                                                      *
//                "0" : product price,                                  *
//                "1" : difference between old and new prices,          *
//                "2" : total quantity of products,                     *
//                "3" : ending of the product (товар, товарА, товарОВ)  *
//               }                                                      *
//***********************************************************************
    public function changeQuantityProducts($productData)
    {
        $productData = explode("***", $productData);    // productData = product ID *** product quantity
        $id = $productData[0];
        $quantity = $productData[1];

        $resultChange = $this->changeCart($id, $quantity);      // $resultChange[0] = $price, $resultChange[1] =  $difference
        $resultChange[2] = $this->getTotalQuantity();
        $resultChange[3] = MyHelpers::productsEnding($resultChange[2]);
        $resultChange = json_encode($resultChange);             // AJAX use JSON data, because convert result in JSON format

        return $resultChange;
    }


    /**
     * Determination total products amount in cart
     *
     * @return int
     */
    public function getTotalQuantity ()
    {
        $session = Yii::$app->session;
        $session->open();

        if (!$session->has('cart')) {
            $cart = [];
        } else {
            $cart = $session->get('cart');
        }

        $session->close();

        $totalQuantity = 0;
        foreach ($cart as $product) {
            if ($product['quantity']) {
                $totalQuantity += $product['quantity'];
            }
        }

        return $totalQuantity;
    }


    /**
     * Delete Cart from SESSION when total quantity of products = 0
     *
     * @param $totalQuantity
     */
    public function cartCapacityTest ($totalQuantity)
    {
        if ($totalQuantity == 0){
            $session = Yii::$app->session;
            $session->open();
            if ($session) {
                Yii::$app->session->destroy();
            }
            $session->close();
        }

        return;
    }


    /**
     * Change product quantity in Cart
     * Return: $resultChange[0] = $price, $resultChange[1] =  $difference
     *
     * @param $number
     *
     * @param $quantity
     *
     * @return array
     */
    private function changeCart ($number, $quantity)
    {
        $price = $difference = 0;
        $session = Yii::$app->session;
        $session->open();
        if ($session){
            $cart = $session->get('cart');
            $oldPrice = $cart[$number]["quantity"] * $cart[$number]["price"];
            $cart[$number]["quantity"] = $quantity;
            $session->set('cart', $cart);

            $price = $cart[$number]["quantity"] * $cart[$number]["price"];
            $difference = $price - $oldPrice;               // "difference" using for determination NEW total price in "cartList" view
            if (isset($cart ["promoCode"]["discount"])){
                $difference = $difference - $difference * $cart ["promoCode"]["discount"];  // change difference when discount is present
            }
        }
        $session->close();
        $resultChange = array("0" => $price, "1" => $difference);

        return $resultChange;
    }


    /**
     * Change delivery type
     *
     * @param $deliveryType
     *
     * @return mixed
     */
    public function changeDelivery ($deliveryType)
    {   // change delivery type
        $session = Yii::$app->session;
        $session->open();
        if ($session->has('cart')) {
            $cart = $session->get('cart');
            $cart ["delivery"]["deliveryType"] = $deliveryType;
        }
        else { $cart ["delivery"]["deliveryType"] = "Новая почта"; }
        $session->set('cart', $cart);
        $session->close();

        return $deliveryType;
    }


    /**
     * Change purchase type
     *
     * @param $purchaseType
     *
     * @return mixed
     */
    public function changePurchase ($purchaseType)
    {
        $session = Yii::$app->session;
        $session->open();

        if ($session->has('cart')) {
            $cart = $session->get('cart');
            $cart ["purchase"]["purchaseType"] = $purchaseType;
        }
        else{
            $cart ["purchase"]["purchaseType"] = "Наложным платежом";
        }

        $session->set('cart', $cart);
        $session->close();

        return $purchaseType;
    }


    /**
     * Testing promo code authenticity
     *
     * @param $promoCode
     *
     * @return float|int
     */
    public function checkPromoCode($promoCode)
    {
        $discount = 0;
        if ($promoCode === "Family"){
            $session = Yii::$app->session;
            $session->open();
            $cart = $session->get('cart');
            $discount = 0.15;
            $cart ["promoCode"]["discount"] = $discount;
            $session->set('cart', $cart);
            $session->close();
        }

        return $discount;
    }
}