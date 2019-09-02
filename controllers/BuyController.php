<?php

namespace app\controllers;

use app\models\Works;
use yii\web\Controller;
use yii\db\Query;

///* @var $productAddress float */
class BuyController extends Controller
{
    public function actionPresentation($singerId)
    {
        $productAddress = Works::find()->where("id=$singerId")->one();

//        $query->select(['notes'])->from('singer')->where(['id' => $singerId])->one();
//        $productAddress = $query;

        return $this->render('presentation', [
            'productAddress' => $productAddress
        ]);
    }
}

