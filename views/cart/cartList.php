<?php

/* @var $this yii\web\View */
/* @var $pillows array */
/* @var $linens array */
/* @var $totalQuantity float */

/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CustomerForm */


/* @var $myTemp array */
/* @var $productsEnding array */

use yii\bootstrap\ActiveForm;
//use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use app\common\components\MyHelpers;
use app\common\components\TextFile;

//$this->title = 'Корзина';
//$this->params['breadcrumbs'][] = $this->title;

$productsEnding = new MyHelpers();
$textFile = new TextFile();
?>

<?php $cart = $items; ?>


<?php
//echo '<pre>';
//print_r($items);
//echo '</pre>';
?>
<?php
//foreach ($cart as $item){
//    if ($item['deliveryType']) {
//        echo $item['deliveryType'];
//    }
//    print_r($item);
//    echo "<br>";
//}
?>


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

                    <?php   $deliveryType = "Новая Почта"; $purchaseType = "Наложным платежом";
                            if ($cart):
                                foreach ($cart as $item):                           // set active radio button DELIVERY TYPE
                                    if ($item['deliveryType']) {                    // and PURCHASE TYPE in case if
                                        $deliveryType = $item['deliveryType'];      // it  was selected before
                                    }
                                    if ($item['purchaseType']) {
                                        $purchaseType = $item['purchaseType'];
                                    }
                                endforeach;
                            endif;
                    ?>

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
                    <tr>
                        <td class="deliveryTypeInTable" colspan="3" class="text-center">Тип доставки: <?php echo $deliveryType; ?></td>
                        <td class="purchaseTypeInTable" colspan="2" class="text-center">Способ оплаты: <?php echo $purchaseType; ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <div class="cartStatus"> <p>Ваша корзина пуста</p> </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-1"></div>
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

<div class="purchaseRegistration row">
    <div class="deliveryMethod col-12 col-lg-4">
        <h4>ВЫБЕРИТЕ СПОСОБ ДОСТАВКИ</h4>
        <?php for ($i=1; $i<=3; $i++):
          switch ($i){
              case 1: $deliveryTypeTemp = "Новая Почта"; $deliveryFile = $textFile->newPost(); break;
              case 2: $deliveryTypeTemp = "Курьером"; $deliveryFile = $textFile->courier(); break;
              case 3: $deliveryTypeTemp = "Самовывоз (бесплатно)"; $deliveryFile = $textFile->pickup(); break;
          }
        ?>
            <div class="delivery<? echo $i; ?> row">
                <div class="col-2">
                    <input class="typeDeliveryJS" type="radio" name="deliveryID" value="<?php echo $deliveryTypeTemp;?>"
                        <?      if (($i==1) && ($deliveryType == "Новая Почта")) { echo "checked"; }
                                if (($i==2) && ($deliveryType == "Курьером")) { echo "checked"; }
                                if (($i==3) && ($deliveryType == "Самовывоз (бесплатно)")) { echo "checked"; }
                        ?>
                    >
                 </div>
                <div class="onlyCSSinDelivery col-10">
                    <label class="typeDelivery"><? echo $deliveryTypeTemp; ?></label><br>
                    <label><?php echo $deliveryFile; ?></label>
                </div>
            </div>
        <?php endfor; ?>
    </div>



<?php
$deliveryTypeJS = <<<JS
    $('.typeDeliveryJS').change(function() {
        var deliveryTypeJS = ($(this).val());
         $.ajax({
            url: '/cart/delivery',
            data: {deliveryTypeJS: deliveryTypeJS},
            type: 'POST',
            success: function (deliveryType) {
                console.log(deliveryType);
                $('.deliveryTypeInTable').html("Тип доставки: "+ deliveryType);
             },
            error: function () {
                console.log ("Failed");            //  NEED !!!!!!!!!!  better delete???????
            }
        });
    })
JS;
$this->registerJs($deliveryTypeJS);
?>

    <div class="purchaseInformation col-12 col-lg-4">
        <h4>ВЫБЕРИТЕ СПОСОБ ОПЛАТЫ</h4>
        <?php for ($i=1; $i<=3; $i++):
            switch ($i){
                case 1: $purchaseTypeTemp = "Наложным платежом"; break;
                case 2: $purchaseTypeTemp = "На карту Приват-банка"; break;
                case 3: $purchaseTypeTemp = "Наличными"; break;
            }
            ?>
            <div class="purchase<? echo $i; ?> row">
                <div class="col-2">
                    <input class="typePurchaseJS" type="radio" name="purchaseID" value="<?php echo $purchaseTypeTemp;?>"


                    <?  if (($i==1) && ($purchaseType == "Наложным платежом")) { echo "checked"; }
                        if (($i==2) && ($purchaseType == "На карту Приват-банка")) { echo "checked"; }
                        if (($i==3) && ($purchaseType == "Наличными")) { echo "checked"; }
                    ?>

                    <?// if ($i==1) { echo "checked"; } ?>
                    >
                </div>
                <div class="onlyCSSinPurchase col-10">
                    <label class="typePurchase"><? echo $purchaseTypeTemp; ?></label><br>
                    <?php   if ($i==1) { echo "<label>" . '(данный способ оплаты возможен при отправке товара "Новой Почтой")' . "</label>"; }
                            if ($i==2) { echo "<label>" . "(банковские реквизиты будут высланы Вам после оформления заказа)" . "</label>"; }
                    ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>


    <?php
    $purchaseTypeJS = <<<JS
    $('.typePurchaseJS').change(function() {
        var purchaseTypeJS = ($(this).val());
         $.ajax({
            url: '/cart/purchase',
            data: {purchaseTypeJS: purchaseTypeJS},
            type: 'POST',
            success: function (purchaseType) {
                console.log(purchaseType);
                $('.purchaseTypeInTable').html("Способ оплаты: "+ purchaseType);
             },
            error: function () {
                console.log ("Failed");            //  NEED !!!!!!!!!!  better delete???????
            }
        });
    })
JS;
    $this->registerJs($purchaseTypeJS);
    ?>


    <div class="contactInformation col-12 col-lg-4">
        <h4>КОНТАКТНАЯ ИНФОРМАЦИЯ</h4>
        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
            <div class="alert alert-success">
                Благодарим Вас за обращение к нам. Мы ответим Вам как можно скорее.
            </div>
<!--                    <p>-->
<!--                        Note that if you turn on the Yii debugger, you should be able-->
<!--                        to view the mail message on the mail panel of the debugger.-->
<!--                        --><?php //if (Yii::$app->mailer->useFileTransport): ?>
<!--                            Because the application is in development mode, the email is not sent but saved as-->
<!--                            a file under <code>--><?//= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?><!--</code>.-->
<!--                            Please configure the <code>useFileTransport</code> property of the <code>mail</code>-->
<!--                            application component to be false to enable email sending.-->
<!--                        --><?php //endif; ?>
<!--                    </p>-->
        <?php else: ?>
            <div class="row">
                <div class="contactInformation col-lg-12">
                    <?php $form = ActiveForm::begin(['id' => 'my-contact']); ?>
                        <?= $form->field($model, 'name', ['enableLabel' => false])->textInput(array('placeholder' => 'Ваше имя', 'class'=>'form-control text-center')) ?>
                        <?= $form->field($model, 'email', ['enableLabel' => false])->textInput(['placeholder' => 'Email', 'class'=>'form-control text-center']) ?>
                        <?= $form->field($model, 'phone', ['enableLabel' => false])->textInput(['placeholder' => 'Ваш номер телефона', 'class'=>'form-control text-center']) ?>
<!--                        --><?//= $form->field($model, 'subject', ['enableLabel' => false]) ?>
                        <?= $form->field($model, 'body', ['enableLabel' => false])->textarea(['rows' => 4, 'placeholder' => 'Коментарии к заказу', 'class'=>'form-control text-center']) ?>
<!--                        --><?//= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
//                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
//                        ]) ?>
                        <div class="form-group">
                            <?= Html::submitButton('Подтвердите заказ', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>


