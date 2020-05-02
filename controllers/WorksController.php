<?php

namespace app\controllers;

use app\models\Works;
use yii\web\Controller;


class WorksController extends Controller
{
    public function actionPortfolio()
    {
        $items = Works::find()->all();          // "Works" - associative array from DB with data about our works.
        return $this->render('works', [    // This data (like the photo address, photo description) is used for
            'worksList' => $items,              //   display of the cards with our works and it description.
        ]);
    }

}