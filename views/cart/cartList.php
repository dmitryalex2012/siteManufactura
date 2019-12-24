<?php

/* @var $this yii\web\View */
/* @var $pillows array */
/* @var $linens array */
/* @var $totalQuantity float */


/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */


/* @var $myTemp array */
/* @var $productsEnding array */

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use app\common\components\MyHelpers;
use app\common\components\TextFile;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;

$productsEnding = new MyHelpers();
$textFile = new TextFile();
?>

<?php $cart = $items; ?>
<h2>В КОРЗИНЕ - <? echo $totalQuantity . " " . $productsEnding->productsEnding($totalQuantity); ?></h2>
<br>

    <div class="cartTable row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <?php if (!empty($cart)): ?>
                <?php $price = 0; ?>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">Наименование</th>
                        <th class="text-center">Код товара</th>
                        <th class="text-center">Количество</th>
                        <th class="text-center">Цена, грн</th>
                        <th class="text-center">Сумма, грн.</th>
                    </tr>
                    <?php foreach ($cart as $item): ?>
                        <?php if ($item['quantity'] != 0): ?>
                            <tr>
                                <td><?= $item['title']; ?></td>
                                <td><?= $item['number']; ?></td>
                                <td>
                                    <select class="quantityAjax">
                                        <?php for ($i=0; $i<=10; $i++): ?>
                                        <option value="<?php echo ($item['number']) . "***" . $i; ?>"
                                          <?php if ($item['quantity'] == $i) echo "selected" ?> >
                                            <? echo $i ?>
                                        </option>
                                        <?php endfor; ?>
                                    </select>
                                </td>
                                <td><?= $item['price']; ?></td>
                                <td class="<?php echo $item['number']; ?>"><?= $item['price'] * $item['quantity']; ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php $price += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-right">Итого:</td>
                        <td id="totalPrice" abbr="<?php echo $price?>"><?= $price; ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <div class="cartStatus"> <p>Ваша корзина пуста</p> </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-1"></div>
</div>


<div class="purchaseRegistration row">
    <div class="deliveryMethod col-12 col-lg-6">
        <h4>ВЫБЕРИТЕ СПОСОБ ДОСТАВКИ</h4>
        <div class="delivery1 row">
            <div class="col-1">
                <input type="radio" name="deliveryID" checked>
            </div>
            <div class="col-11">
                <label class="typeDelivery1">Новая почта</label><br>
                <label><?php echo $textFile->newPost(); ?></label>
            </div>
        </div>
        <div class="delivery2 row">
            <div class="col-1">
                <input type="radio" name="deliveryID">
            </div>
            <div class="col-11">
                <label class="typeDelivery2">Курьером</label><br>
                <label><?php echo $textFile->courier(); ?></label>
            </div>
        </div>
        <div class="delivery3 row">
            <div class="col-1">
                <input type="radio" name="deliveryID">
            </div>
            <div class="col-11">
                <label class="typeDelivery3">Самовывоз (бесплатно)</label><br>
                <label><?php echo $textFile->pickup(); ?></label>
            </div>
        </div>
    </div>
    <div class="contactInformation col-12 col-lg-6">
        <h4>КОНТАКТНАЯ ИНФОРМАЦИЯ</h4>


        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
            <div class="alert alert-success">
                Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.
            </div>
            <!--        <p>-->
            <!--            Note that if you turn on the Yii debugger, you should be able-->
            <!--            to view the mail message on the mail panel of the debugger.-->
            <!--            --><?php //if (Yii::$app->mailer->useFileTransport): ?>
            <!--                Because the application is in development mode, the email is not sent but saved as-->
            <!--                a file under <code>--><?//= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?><!--</code>.-->
            <!--                Please configure the <code>useFileTransport</code> property of the <code>mail</code>-->
            <!--                application component to be false to enable email sending.-->
            <!--            --><?php //endif; ?>
            <!--        </p>-->
        <?php else: ?>
            <div class="row">
                <div class="contactInformation col-lg-12">

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <?= $form->field($model, 'name', ['enableLabel' => false])->textInput(array('placeholder' => 'Ваше имя', 'class'=>'form-control text-center')) ?>
                    <?= $form->field($model, 'email', ['enableLabel' => false])->textInput(['placeholder' => 'Email', 'class'=>'form-control text-center']) ?>
                    <?= $form->field($model, 'body', ['enableLabel' => false])->textarea(['rows' => 3, 'placeholder' => 'Коментарии к заказу', 'class'=>'form-control text-center']) ?>
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Подтвердите заказ', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        <?php endif; ?>


    </div>
</div>


<?php
$script1 = <<<JS
    $('.quantityAjax').change(function() {
        var productData = $(this).val();
        var classType ="." + productData.substr(0, 4);      // change the price of the selected product
        var totalPrice = document.getElementById('totalPrice').abbr;
        
         $.ajax({
            url: '/cart/change',
            data: {productData: productData},
            dataType : 'json',
            type: 'POST',
            success: function (newPrice) {  // array ("0"=>price, "1"=>difference, "2"=>totalQuantity, "3"=> end of the word "Product")
                $(classType).html(Math.abs(newPrice[0]));                       // new price  for product
                $('#totalPrice').html(Number(totalPrice)+Number(newPrice[1]));  // new total price
                totalPriceClass = document.querySelector("#totalPrice");            // change marker in "total
                totalPriceClass.setAttribute('abbr', String(Number(totalPrice)+Number(newPrice[1])));   //    price"
                $('.classCart').html("Корзина "+newPrice[2]);                   // change quantity in "Header" line
               $('h2').html("В КОРЗИНЕ - " + newPrice[2] + " " + newPrice[3]);  // change quantity in "h2" 

                if (Number(newPrice[2]) == 0) { $('.classCart').html("Корзина"); }
             },
            error: function () {
                console.log ("Failed");            //  NEED !!!!!!!!!!  better delete???????
            }
        });
    });
JS;
$this->registerJs($script1);
?>

