<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Products;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\helpers\Url;
use Yii;

class CartController extends Controller
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

    public function actionIndex()
    {
        $pillows = Cart::find()->all();
        return $this->render('cartList', [
            'items' => $pillows,
        ]);
    }

    public function actionAdd()
    {
//        $linens = Products::find()->where(['categories' => 'linens'])->all();
//        if (!Yii::$app->session->getIsActive()) {Yii::$app->session->open();}
//        Yii::$app->session['product'] = $linens;
//        Yii::$app->session->close();
        if ((Yii::$app->request->isAjax)) {
            $cart = new Cart();
            $productID = Yii::$app->request->post('productID');
//            $productID = $cart->addToCart($productID);
            $temp = $cart->addToCart($productID);


//            $newtemp = '';
//            foreach ($temp as $key=>$item) {
//                if ($key == "number") {
//                    $newtemp = $item;
//                }
//            }
//            if ($newtemp == '') {
//                $newtemp = 'empty';
//            }
//            return $newtemp;



            return $productID;
        }

        $mytemp = "World";
        return $this->render('temp', [
            'temp' => $mytemp
        ]);
    }

}