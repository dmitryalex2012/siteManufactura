<?php

namespace app\controllers;

use app\services\WorksServices;
use yii\web\Controller;


class WorksController extends Controller
{
    /**
     * he service to handle data about our works
     *
     * @var WorksServices
     */
    public $ourWorks;

    public function __construct($id, $module, $config = [])
    {
        $this->ourWorks = new WorksServices();
        parent::__construct($id, $module, $config);
    }


    /**
     * Render  from DB the associative array "Works" with data about our works. This data (like the photo address,
     * photo description) is used for display of the cards with our works and it description.
     *
     * @return string
     */
    public function actionPortfolio()
    {
        $worksList =  $this->ourWorks->getOurWorks();
        return $this->render('works', [
            'worksList' => $worksList,
        ]);
    }

}