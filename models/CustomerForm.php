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
    // Make message form, that will send to seller
            $cart = $session->get('cart');

          //  Information about buyer -------------------------------------------------------
            $messageContent = "Имя: " . $this->name . ";" . "\r\n";
            $messageContent = $messageContent . "Телефон: " . $this->phone . ";" . "\r\n"; //  "\r\n" - write in file with new string and left side
            $messageContent = $messageContent . "e-mail: " . $this->email . ";" . "\r\n";
            $messageContent = $messageContent . "Вид доставки: " . $cart ["delivery"]["deliveryType"] . ";" . "\r\n";
            $messageContent = $messageContent . "Форма оплаты: " . $cart["purchase"]["purchaseType"] .  ";" . "\r\n";
            $messageContent = $messageContent . "Сообщение Заказчика: " . $this->body . "." . "\r\n" . "\r\n";
            $messageContent = $messageContent . "СОСТАВ ЗАКАЗА: " . "\r\n" . "\r\n";
          //  End information about buyer ---------------------------------------------------
            $totalPrice = 0;

          //  information about selected products -------------------------------------------
            foreach ($cart as $item){
                if ($item['quantity'] != 0){
                    $itemPrice = 0;
                    $messageContent = $messageContent . "Номер товара: " . $item['number'] . "\r\n";
                    $messageContent = $messageContent . "Категория: " . $item['title'] . "\r\n";
                    $messageContent = $messageContent . "Название: " . $item['content'] . "\r\n";
                    $messageContent = $messageContent . "Количество: " . $item['quantity'] . "\r\n";
                    $itemPrice = $itemPrice + $item['price'] * $item['quantity'];
                    $messageContent = $messageContent . "Стоимость товаров под даным номером: " . $itemPrice . "\r\n" . "\r\n";
                    $totalPrice = $totalPrice + $itemPrice;
                }
            }
            $messageContent = $messageContent . "Общая стоимость заказа: " . $totalPrice;
          //  end information about selected products ---------------------------------------
        }
        $session->close();

        if ($this->validate()) {            //  sending mail to buyer
            Yii::$app->mailer->compose()
//                ->setTo([$this->email])
                ->setTo(['snn.manufactura@gmail.com', 'DmitryAlex2012@gmail.com'])      // send mail to buyer and mine mail
//                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
//                ->setFrom(['tpmfd27@gmail.com' => $this->name])
                ->setFrom([$email])
//                ->setReplyTo($email)
                ->setSubject($this->name)
                ->setTextBody($messageContent)
                ->send();
            return true;
        }
        return false;
    }
}