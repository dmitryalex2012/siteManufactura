<?php

namespace app\controllers;

use app\models\Products;
use app\services\ProductServices;
use yii\web\Controller;
use Yii;

class ProductsController extends Controller
{
    private $productServices;

    public function __construct($id, $module, $config = [])
    {
        $this->productServices = new ProductServices();
        parent::__construct($id, $module, $config);
    }


    public function actionList()
    {
        $result = Products::find()->where(['categories' => 'pillow'])->all();   // when "Pillow" item is selected
        switch (Yii::$app->request->get('value')){      // or:      switch ($_GET['value']){
            case 'apero':   $result = Products::find()->where(['categories' => 'apero'])->all();    break;
            case 'linens':  $result = Products::find()->where(['categories' => 'linens'])->all();   break;
            case 'towel':   $result = Products::find()->where(['categories' => 'towel'])->all();    break;
            case 'baby':    $result = Products::find()->where(['categories' => 'baby'])->all();     break;
        }

        return $this->render('ourProducts', [
            'items' => $result
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