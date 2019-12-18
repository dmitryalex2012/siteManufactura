<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CustomerForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
//            [['name', 'email', 'subject', 'body'], 'required', 'message'=>'Не заполнено поле'],
            [['name', 'email', 'subject', 'body'], 'required', 'message'=>'Не заполнено поле'],
            // email has to be a valid email address
            ['email', 'email', 'message'=>'Некорректный e-mail'],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
//                ->setTo([$this->email => $this->name])
                ->setTo([$this->email])
//                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
//                ->setFrom(['tpmfd27@gmail.com' => $this->name])
                ->setFrom(['tpmfd27@gmail.com'])
//                ->setReplyTo($email)
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
