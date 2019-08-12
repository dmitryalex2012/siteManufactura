<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $email;
    public $pass;
    public $firstName;
    public $lastName;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'pass', 'firstName', 'lastName'], 'required'],
            [['email', 'pass', 'firstName', 'lastName'], 'string'],
            [['email'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
           'pass' => 'Password'
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->email = $this->email;
        $user->pass = $this->pass;
        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();
        return $user;
    }
}
