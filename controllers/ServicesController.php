<?php

namespace app\controllers;

use app\models\Services;
use yii\web\Controller;


class ServicesController extends Controller
{
     public function actionList()
    {
        $items = Services::find()->all();       // "Services" - associative array from DB with data about our services.
        return $this->render('list', [     // This data (like the photo address, service description) is used
            'services' => $items,               //    for display on card in view page.
        ]);
    }
}
