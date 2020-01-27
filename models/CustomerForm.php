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
            $messageContent = "Корзина пуста";
        } else {
            $cart = $session->get('cart');
            $messageContent = "Имя: " . $this->name . ";" . "\r\n";
            $messageContent = $messageContent . "Телефон: " . $this->phone . ";" . "\r\n";
            $messageContent = $messageContent . "Вид доставки: " . $cart ["delivery"]["deliveryType"] . ";" . "\r\n"; //  "\r\n" - write in file with new string
            $messageContent = $messageContent . "Форма оплаты: " . $cart["purchase"]["purchaseType"] .  ";" . "\r\n";
            $messageContent = $messageContent . "Сообщение Заказчика: " . $this->body . "." . "\r\n" . "\r\n";
            $messageContent = $messageContent . "Состав заказа: " . "\r\n" . "\r\n";
            $totalPrice = 0;
            foreach ($cart as $item){
                if ($item['quantity'] != 0){
                    $itemPrice = 0;
                    $messageContent = $messageContent . "Номер товара: " . $item['number'] . "\r\n";
                    $messageContent = $messageContent . "Название: " . $item['title'] . "\r\n";
                    $messageContent = $messageContent . "Количество: " . $item['quantity'] . "\r\n";
                    $messageContent = $messageContent . "Стоимость товаров под даным номером: " .
                        $itemPrice = $itemPrice + $item['price'] * $item['quantity'] . "\r\n" . "\r\n";
                    $totalPrice = $totalPrice + $itemPrice;
                }

            }
            $messageContent = $messageContent . "Общая стоимость заказа: " . $totalPrice;
        }
        $session->close();

        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo([$this->email])
//                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
//                ->setFrom(['tpmfd27@gmail.com' => $this->name])
                ->setFrom(['tpmfd27@gmail.com'])
//                ->setReplyTo($email)
                ->setSubject($this->name)
                ->setTextBody($messageContent)
                ->send();
            return true;
        }
        return false;
    }
}