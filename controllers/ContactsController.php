<?php

namespace app\controllers;

use yii\web\Controller;


class ContactsController extends Controller
{
    /**
     * Renders view page.
     *
     * @return string
     */
    public function actionLoad()
    {
        return $this->render('ourContacts');
    }
}