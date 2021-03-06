<?php
namespace app\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator2;
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
//    public $verifyCode;
    public $code;

    public $reCaptcha;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
//            [['name', 'email', 'subject', 'body'], 'required', 'message'=>'Не заполнено поле'],

            [['name', 'email', 'phone'], 'required', 'message'=>'Не заполнено поле'],
            ['body', 'string', 'min' => 0],

            // email has to be a valid email address
            ['email', 'email', 'message'=>'Некорректный e-mail'],

            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
//            ['verifyCode', 'captcha', 'captchaAction'=>'cart/captcha'],

            [['reCaptcha'], ReCaptchaValidator2::className(),
                'secret' => '6Lc-VKYZAAAAADzlOjaP0sPnafw221YJ1lb70FAl', // unnecessary if reСaptcha is already configured
//                'secret' => '6Le5gagZAAAAAPo4phWXR7XRg-YWvjgO6Eq4NBZy', // (V2 for designburoshtor.website) unnecessary if reСaptcha is already configured
//                'uncheckedMessage' => 'Please confirm that you are not a bot.'
            ],
        ];
    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Введите код проверки:',
        ];
    }
    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        $orderNumber = date("dmyHis");

        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('cart')) {
            $messageContent = $reply = "Корзина пуста";
        } else {
    /** Make message form, that will send to seller */
            $cart = $session->get('cart');

          /**  Start of the customer information */
            $messageContent = "Имя: " . $this->name . ";" . "\r\n";
            $messageContent = $messageContent . "Телефон: " . $this->phone . ";" . "\r\n"; //  "\r\n" - write in file with new string and left side
            $messageContent = $messageContent . "e-mail: " . $this->email . ";" . "\r\n";
            $messageContent = $messageContent . "Номер заказа: " . $orderNumber . ";" . "\r\n";
            $messageContent = $messageContent . "Вид доставки: " . $cart ["delivery"]["deliveryType"] . ";" . "\r\n";
            $messageContent = $messageContent . "Форма оплаты: " . $cart["purchase"]["purchaseType"] .  ";" . "\r\n";
            $messageContent = $messageContent . "Сообщение Заказчика: " . $this->body . "\n" . "\r\n";
            $messageContent = $messageContent . "СОСТАВ ЗАКАЗА: " . "\n" . "\r\n";
          /**  End of the customer information  */
            $totalPrice = 0;

          /** Start of the selected products information */
            $reply = "";
            foreach ($cart as $item){
                if ($item['quantity'] != 0){
                    $reply = $reply . "Номер товара: " . $item['number'] . "\r\n";
                    $reply = $reply . "Категория: " . $item['title'] . "\r\n";
                    $reply = $reply . "Название: " . $item['content'] . "\r\n";
                    $reply = $reply . "Количество: " . $item['quantity'] . "\r\n";
                    $itemPrice = $item['price'] * $item['quantity'];
                    $reply = $reply . "Стоимость товаров под даным номером: " . $itemPrice . " грн." . "\n" . "\r\n";
                    $totalPrice = $totalPrice + $itemPrice;
                }
            }
            $discountMessage = ":";
            if ($cart["promoCode"]["discount"] != 0){       // change total price using discount
                $totalPrice = $totalPrice - $totalPrice * $cart["promoCode"]["discount"];
                $discountMessage = " с учетом скидки " . $cart["promoCode"]["discount"] * 100 . "%" . " составляет: ";
            }
            $reply = $reply . "Общая стоимость заказа " . $discountMessage . $totalPrice . " грн.";
            $messageContent = $messageContent . $reply;
          /**  End selected products information */
        }
        $session->close();

        if ($this->validate()) {
            /** array "$customerMessage" is used in "cartList" view for determine validation */
            Yii::$app->session->addFlash('customerMessage', $orderNumber);  // $customerMessage[0] = $orderNumber;
            Yii::$app->mailer->compose()                                        //  sending mail to TM "Manufaktura"
                ->setTo(['snn.manufactura@gmail.com', 'DmitryAlex2012@gmail.com'])      // send mails
                ->setFrom([$email])
                ->setSubject($this->name)
                ->setTextBody($messageContent)
                ->send();

            $reply = "Здравствуйте." . "\r\n" . "Номер Вашего заказа:" . $orderNumber . "." . "\n" . "\r\n" .
                        "Состав заказа:" . "\n" . "\r\n" . $reply . "\r\n" .
                        "Спасибо за то, что выбрали нас. Наш дизайнер свяжется с Вами в ближайшее время.";
            Yii::$app->mailer->compose()
                ->setTo([$this->email])                 // send mail to customer
                ->setFrom(['tpmfd27@gmail.com'])
                ->setSubject("Администратор Дмитрий")
                ->setTextBody($reply)
                ->send();

            return true;
        }
        return false;
    }
}