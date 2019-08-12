<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use Yii;
use yii\web\Controller;

/**
 * AuthController implements the CRUD actions for User model.
 */
class AuthController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = $model->signup();
            if (Yii::$app->user->login($user)){
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
