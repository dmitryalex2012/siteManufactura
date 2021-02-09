<?php

namespace app\controllers;

use app\services\WorksServices;
use yii\base\InvalidConfigException;
use yii\web\Controller;


class WorksController extends Controller
{
    /**
     * Render from DB the associative array "Works" with data about our works. This data (like the photo address,
     * photo description) is used for display of the cards with our works and it description.
     *
     * @return string
     * @throws InvalidConfigException
     */
    public function actionPortfolio()
    {
        $worksList =  WorksServices::getOurWorks();

        return $this->render('works', [
            'worksList' => $worksList,
        ]);
    }

}