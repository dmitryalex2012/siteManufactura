<?php

namespace app\controllers;

use app\models\Products;
use yii\web\Controller;
use Yii;

class ProductsController extends Controller
{
    // this is OLD VERSION ---------------------------------------------------------
//    public function actionPillows()
//    {
//        $product = Products::find()->where(['categories' => 'pillow'])->all();
//        if (!Yii::$app->session->getIsActive()) { Yii::$app->session->open(); }
//        Yii::$app->session['product'] = $product;
//        Yii::$app->session->close();
//        return $this->redirect('summary');
//    }
//
//    public function actionSummary()
//    {
//        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
//        $result = Yii::$app->session['product'];
//        Yii::$app->session->close();
//        return $this->render('ourProducts', [
//            'items' => $result
//        ]);
//    }
    // finish OLD VERSION ---------------------------------------------------------


    public function actionList()
    {
        $result = Products::find()->where(['categories' => 'pillow'])->all();   // when "Pillow" item is selected
        switch (Yii::$app->request->get('value')){
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