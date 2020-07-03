<?php

namespace app\controllers;

use app\models\Products;
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
     * Render list of products by specified category
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

    public function actionDetail()
    {
        $selectedProduct = Products::find()->where(['number' => Yii::$app->request->get('productID')])->one();
        return $this->render('details', [
            'product' => $selectedProduct
        ]);
    }
}