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
//    public $subject;
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
            [['name', 'email', 'body', 'phone'], 'required', 'message'=>'Не заполнено поле'],
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
        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $temp = "Корзина пуста";
        } else {
            $cart = $session->get('cart');
            $temp = "Имя:" . $this->name . ";" . "\r\n";        //  "\r\n" - write in file with new string
            $temp = $temp . "Телефон: " . $this->phone . ";" . "\r\n";
            $temp = $temp . "Сообщение: " . $this->body . ";" . "\r\n";
            $temp = $temp . "Вид доставки: " . $cart ["delivery"]["deliveryType"] . ";" . "\r\n" . "\r\n" . "Состав заказа:" . "\r\n";
            foreach ($cart as $item){
                if ($item['quantity'] != 0){
                    $temp = $temp . "Номер: " . $item['number'] . "\r\n";
                    $temp = $temp . "Название: " . $item['title'] . "\r\n";
                    $temp = $temp . "Количество: " . $item['title'] . "\r\n";
                    $temp = $temp . "Стоимость товаров под даным номером: " . $item['price'] * $item['quantity'] . "\r\n";
                }

            }

//            $temp = json_encode($temp);
        }
        $session->close();

        if ($this->validate()) {
            Yii::$app->mailer->compose()
//                ->setTo([$this->email => $this->name])
                ->setTo([$this->email])
//                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
//                ->setFrom(['tpmfd27@gmail.com' => $this->name])
                ->setFrom(['tpmfd27@gmail.com'])
//                ->setReplyTo($email)
//                ->setSubject($this->subject)
                ->setSubject($this->name)
//                ->setTextBody($this->$temp)
                ->setTextBody($temp)
                ->send();
            return true;
        }
        return false;
    }
}