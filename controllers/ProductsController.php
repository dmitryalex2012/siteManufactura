<?php

namespace app\controllers;

use app\models\Products;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\helpers\Url;
use Yii;

class ProductsController extends Controller
{
//    public function actionIndex()
//    {
//        echo 'Hello';
//    }
//    public function actionPeople()
//    {
//        return $this->render('people');
//        return $this->renderPartial('people');
//        return $this->asJson(['test' => 1]);
//        return $this->asJson(['test' => (object)['test' => 1]]);
//        return $this->render('people', ['countTotal' => 6000000000]);


//        return $this->render('people', [
//            'countTotal' => 6000000000,
//            'title' => 'My page of oldProducts people'
//        ]);
//    }
//
//    public function actionNames()
//    {
//
//    }
//}


//    public function actionList()
//    {
//        $items = Works::find()->where(['id'=>1]);
//
//        $items = Works::find()->all();
//
//        $items = Works::find()->asArray()->all();
//
//        return $this->render('list', [
//            'countTotal' => 6000000000,
//            'title' => 'My page of world people',
//            'items' => $items
//        ]);
//    }
//}





//    public function actionPillows()
//    {
//        $pillows = Products::find()->where(['categories' => 'pillow'])->all();
//        return $this->render('ourProducts', [
//            'items' => $pillows,
//            'name' => "подушки",
//        ]);
//    }
//
//    public function actionLinens()
//    {
//        $linens = Products::find()->where(['categories' => 'linens'])->all();
//        return $this->render('ourProducts', [
//            'items' => $linens,
//            'name' => "постельное белье",
//        ]);
//    }
//
//    public function actionApero()
//    {
//        $apero = Products::find()->where(['categories' => 'apero'])->all();
//        return $this->render('ourProducts', [
//            'items' => $apero,
//            'name' => "apero",
//        ]);
//    }



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

    public function actionApero()
    {
        $apero = Products::find()->where(['categories' => 'apero'])->all();
        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
        Yii::$app->session['product'] = $apero;
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

    public function actionAddcart()
    {
//        $linens = Products::find()->where(['categories' => 'linens'])->all();
//        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
//        Yii::$app->session['product'] = $linens;
//        Yii::$app->session->close();
        return $this->render('temp');
    }

    public function actionSample()
    {
//        $linens = Products::find()->where(['categories' => 'linens'])->all();
//        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
//        Yii::$app->session['product'] = $linens;
//        Yii::$app->session->close();
        if ((Yii::$app->request->isAjax)) {
            $mytemp = "World";
            return $mytemp;
        }

        $mytemp = "World";
        return $this->render('temp', [
            'temp' => $mytemp
        ]);
    }


}