<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Products;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\helpers\Url;
use Yii;

class ProductsController extends Controller
{
    public function actionPillows()
    {
        $product = Products::find()->where(['categories' => 'pillow'])->all();
        if (!Yii::$app->session->getIsActive()) { Yii::$app->session->open(); }
        Yii::$app->session['product'] = $product;
        Yii::$app->session->close();
        return $this->redirect('summary');
    }

    public function actionLinens()
    {
        $linens = Products::find()->where(['categories' => 'linens'])->all();
        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
        Yii::$app->session['product'] = $linens;
        Yii::$app->session->close();
        return $this->redirect('summary');
    }

    public function actionTowels()
    {
        $linens = Products::find()->where(['categories' => 'towel'])->all();
        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
        Yii::$app->session['product'] = $linens;
        Yii::$app->session->close();
        return $this->redirect('summary');
    }

    public function actionApero()
    {
        $apero = Products::find()->where(['categories' => 'apero'])->all();
        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
        Yii::$app->session['product'] = $apero;
        Yii::$app->session->close();
        return $this->redirect('summary');
    }

    public function actionBaby()
    {
        $baby = Products::find()->where(['categories' => 'baby'])->all();
        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
        Yii::$app->session['product'] = $baby;
        Yii::$app->session->close();
        return $this->redirect('summary');
    }

    public function actionSummary()
    {
        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
        $result = Yii::$app->session['product'];
        Yii::$app->session->close();
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