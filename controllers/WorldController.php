<?php

namespace app\controllers;

use app\models\Singer;
use yii\helpers\VarDumper;
use yii\web\Controller;

class WorldController extends Controller
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
//            'title' => 'My page of world people'
//        ]);
//    }
//
//    public function actionNames()
//    {
//
//    }
//}


    public function actionPeople()
    {
        //    $items = Singer::find()->where(['id'=>1]);
//        $items = Singer::find()->all();
        $items = Singer::find()->asArray()->all();
        return $this->render('people', [
            'countTotal' => 6000000000,
            'title' => 'My page of world people',
            'items' => $items
        ]);
    }
}