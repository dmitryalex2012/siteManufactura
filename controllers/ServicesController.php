<?php

namespace app\controllers;

use app\services\ServicesServices;
use yii\web\Controller;


class ServicesController extends Controller
{
    /**
     * Render from DB the associative array "Services" with data about our services. This data (like
     * the photo address, service description) is used for display on card in view page.
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
     public function actionList()
    {
        $services = ServicesServices::getOurServices();

        return $this->render('list', [
            'services' => $services,
        ]);
    }
}
