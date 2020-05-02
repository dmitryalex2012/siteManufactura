<?php

namespace app\controllers;

use yii\web\Controller;


class ContactsController extends Controller
{
    public function actionLoad()
    {
        return $this->render('ourContacts');
    }
}