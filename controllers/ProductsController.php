<?php

namespace app\controllers;

use app\models\Products;
use yii\helpers\VarDumper;
use yii\web\Controller;

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
    //    $items = Works::find()->where(['id'=>1]);

//        $items = Works::find()->all();

//        $items = Works::find()->asArray()->all();

//        return $this->render('list', [
//            'countTotal' => 6000000000,
//            'title' => 'My page of world people',
//            'items' => $items
//        ]);
//    }
//}

    public function actionList()
    {
        $pillows = Products::find()->where(['categories'=>'pillow'])->all();
        $linens = Products::find()->where(['categories'=>'linens'])->all();
        return $this->render('ourProducts', [
            'pillows' => $pillows,
            'linens' => $linens,
        ]);

//        return $this->render('ourProducts', [
//                'items' => $items,
//        'pillows' => '$pillow',
//        'items' => $pillow,
//        ]);
    }
}