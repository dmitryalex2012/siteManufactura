<?php

namespace app\controllers;

use app\services\ProductServices;
use yii\web\Controller;
use Yii;

class ProductsController extends Controller
{
    /**
     * The service to handle products
     *
     * @var ProductServices
     */
    private $productServices;

    public function __construct($id, $module, $config = [])
    {
        $this->productServices = new ProductServices();
        parent::__construct($id, $module, $config);
    }


    /**
     * Renders list of products by specified category
     *
     * @return string
     */
    public function actionList()
    {
        $category = Yii::$app->request->get('value');
        $products = $this->productServices->getProductsByCategory($category);

        return $this->render('ourProducts', [
            'items' => $products
        ]);
    }


    /**
     * Renders detail information about selected product, that displayed on single page
     *
     * @return string
     */
    public function actionDetail()
    {
        $productID = Yii::$app->request->get('productID');
        $selectedProduct = $this->productServices->getProductByNumber($productID);

        return $this->render('details', [
            'product' => $selectedProduct
        ]);
    }
}