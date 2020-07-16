<?php

/* @var $this yii\web\View */
/* @var $totalQuantity float */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CustomerForm */


/* @var $cart array */


use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\common\components\MyHelpers;
use app\common\components\TextFile;

$textFile = new TextFile();         // text, that describe delivery types in class="deliveryMethod"
?>


<!-- MyHelpers() - make correct word "Product" ("ТОВАР", "ТОВАРА", "ТОВАРОВ") in <h2> inscription -->
<h2>В КОРЗИНЕ - <? echo $totalQuantity . " " . MyHelpers::productsEnding($totalQuantity); ?></h2>

<br>

    <div class="cartTable row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <?php if (!empty($cart)): ?>                    <!-- output table with selected products -->
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
                            if ($cart):                     // Determination DELIVERY TYPE and PURCHASE TYPE in case
                                foreach ($cart as $item):   //    if it was chosen before
                                    if ($item['deliveryType']) {
                                        $deliveryType = $item['deliveryType'];
                                    }
                                    if ($item['purchaseType']) {
                                        $purchaseType = $item['purchaseType'];
                                    }
                                endforeach;
                            endif;
                    ?>

                    <?php foreach ($cart as $item): ?>
                        <?php if ($item['quantity'] != 0): ?>
                            <tr>                                            <!--  output information about products -->
                                <td><?= $item['content']; ?></td>
                                <td><?= $item['number']; ?></td>            <!-- $item['number'] == product ID -->
                                <td>
                                    <label for="idQuantityAjax"></label>    <!-- add empty "label" because "select" need id=for in "label" -->
                                    <select id="idQuantityAjax" class="quantityAjax">
                                        <?php for ($i=0; $i<=10; $i++): ?>  <!-- client can select product quantity from 0 to 10 pieces -->
                                        <option value="<?php echo ($item['number']) . "***" . $i; ?>"
                                          <?php if ($item['quantity'] == $i) echo "selected" ?> >
                                            <? echo $i ?>
                                        </option>
                                        <?php endfor; ?>
                                    </select>
                                </td>
                                <td><?= $item['price']; ?></td>
                                <td class="<?php echo $item['number']; ?>"><?= $item['price'] * $item['quantity']; ?></td>  <!-- summary price for CURRENT product -->
                            </tr>
                        <?php endif; ?>
                        <?php $price += $item['price'] * $item['quantity']; ?>      <!-- "$price" is the total price -->
                    <?php endforeach; ?>

                    <?php
                    if ($cart["promoCode"]["discount"] != 0){             // change total price when promo code is entered
                        $price = $price - $price * $cart["promoCode"]["discount"];
                        $totalPriceInscription = "Стоимость заказа с учетом " . $cart["promoCode"]["discount"]*100 . "% скидки:";
                    } else {
                        $totalPriceInscription = "Итого:";
                    }
                    ?>

                    <tr>
                        <td colspan="4" class="totalPriceDescription text-right"><?= $totalPriceInscription; ?></td>
                        <td id="totalPrice"><?= $price; ?></td>
                    </tr>
                    <tr>
                        <td class="deliveryTypeInTable" colspan="5" class="text-center">Тип доставки: <?php echo $deliveryType; ?></td>
                    </tr>
                    <tr>
                        <td class="purchaseTypeInTable" colspan="5" class="text-center">Способ оплаты: <?php echo $purchaseType; ?></td>
                    </tr>
                </table>

            <?php else: ?>
                <div class="cartStatus"> <p>Ваша корзина пуста</p> </div>
                <br>
            <?php endif; ?>

        </div>
        <div class="col-sm-1"></div>
    </div>

<?php                                                       //  Changing product quantity using "select" tag
$script1 = <<<JS
    $('.quantityAjax').change(function() {
        // let totalPriceClass;
        let classMyCart = $('.classCart');
        let productData = $(this).val();                    // value = product ID *** products quantity
        let classType ="." + productData.substr(0, 4);      // use for set the new summary price of the selected product
        let totalPrice = document.getElementById('totalPrice').innerHTML;

         $.ajax({
            url: '/cart/change',
            data: {productData: productData},
            dataType : 'json',
            type: 'POST',
            success: function (newPrice) {
              // newPrice = array ("0" => price, "1" => difference, "2" => totalQuantity, "3" => end "Product" word)
                $(classType).html(newPrice[0]);                                 // price for new quantity of product
                $('#totalPrice').html(Number(totalPrice)+Number(newPrice[1]));  // new total price
                // totalPriceClass = document.querySelector("#totalPrice");     // change marker in "total"
                classMyCart.html("Корзина "+ newPrice[2]);                       // change quantity in "Header" line
                $('h2').html("В КОРЗИНЕ - " + newPrice[2] + " " + newPrice[3]); // change total quantity in "h2" 

                if (Number(newPrice[2]) === 0) { $('.classCart').html("Корзина"); }
             },
            error: function () {
                console.log ("Failed");
            }
        });
    });
JS;
$this->registerJs($script1);
?>

<div class="purchaseRegistration row">
    <div class="deliveryMethod col-12 col-lg-4">      <!-- Delivery type description -->
        <h4>ВЫБЕРИТЕ СПОСОБ ДОСТАВКИ</h4>
        <?php for ($i=1; $i<=3; $i++):
          switch ($i){                                // select delivery type for description near radio button
              case 1: $deliveryTypeTemp = "Новая Почта";            $deliveryFile = $textFile->newPost();   break;
              case 2: $deliveryTypeTemp = "Курьером";               $deliveryFile = $textFile->courier();   break;
              case 3: $deliveryTypeTemp = "Самовывоз (бесплатно)";  $deliveryFile = $textFile->pickup();    break;
          }
        ?>
            <div class="delivery<? echo $i; ?> row">
                <div class="col-2">                 <!-- using radio buttons delivery determination -->
                    <input id="idTypeDeliveryJS" class="typeDeliveryJS" type="radio" name="deliveryID" value="<?php echo $deliveryTypeTemp;?>"
                        <?      if (($i==1) && ($deliveryType == "Новая Почта"))            { echo "checked"; } // Select active radio button
                                if (($i==2) && ($deliveryType == "Курьером"))               { echo "checked"; } //   of the delivery type
                                if (($i==3) && ($deliveryType == "Самовывоз (бесплатно)"))  { echo "checked"; }
                        ?>
                    >
                 </div>
                <div class="onlyCSSinDelivery col-10">
                    <label for="idTypeDeliveryJS" class="typeDelivery"><? echo $deliveryTypeTemp; ?></label>
                    <br>
                    <label><?php echo $deliveryFile; ?></label>     <!-- additional information about delivery -->
                </div>
            </div>
        <?php endfor; ?>
    </div>


<?php                                               // save new delivery type in DB
$deliveryTypeJS = <<<JS
    $('.typeDeliveryJS').change(function() {
        let deliveryTypeJS = ($(this).val());
         $.ajax({
            url: '/cart/delivery',
            data: {deliveryTypeJS: deliveryTypeJS},
            type: 'POST',
            success: function (deliveryType) {
                $('.deliveryTypeInTable').html("Тип доставки: "+ deliveryType);   <!-- out new delivery type in table for customer -->
             },
            error: function () {
                console.log ("Failed");
            }
        });
    })
JS;
$this->registerJs($deliveryTypeJS);
?>

    <div class="purchaseInformation col-12 col-lg-4">   <!-- Purchase type description -->
        <h4>ВЫБЕРИТЕ СПОСОБ ОПЛАТЫ</h4>
        <?php for ($i=1; $i<=3; $i++):
            switch ($i){                                // Select purchase type for description near radio button
                case 1: $purchaseTypeTemp = "Наложным платежом";        break;
                case 2: $purchaseTypeTemp = "На карту Приват-банка";    break;
                case 3: $purchaseTypeTemp = "Наличными";                break;
            }
            ?>
            <div class="purchase<? echo $i; ?> row">
                <div class="col-2">
                    <input id="idTypePurchaseJS" class="typePurchaseJS" type="radio" name="purchaseID" value="<?php echo $purchaseTypeTemp;?>"
                    <?  if (($i==1) && ($purchaseType == "Наложным платежом")) { echo "checked"; }        // Select active radio button
                        if (($i==2) && ($purchaseType == "На карту Приват-банка")) { echo "checked"; }    //   of the purchase type
                        if (($i==3) && ($purchaseType == "Наличными")) { echo "checked"; }
                    ?>
                    >
                </div>
                <div class="onlyCSSinPurchase col-10">
                    <label for="idTypePurchaseJS" class="typePurchase"><? echo $purchaseTypeTemp; ?></label><br>
                    <?php   if ($i==1) { echo "<label>" . '(данный способ оплаты возможен при отправке товара "Новой Почтой")' . "</label>"; }
                            if ($i==2) { echo "<label>" . "(банковские реквизиты будут высланы Вам после оформления заказа)" . "</label>"; }
                    ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <?php          // save new purchase type in DB
    $purchaseTypeJS = <<<JS
    $('.typePurchaseJS').change(function() {
        let purchaseTypeJS = ($(this).val());
         $.ajax({
            url: '/cart/purchase',
            data: {purchaseTypeJS: purchaseTypeJS},
            type: 'POST',
            success: function (purchaseType) {
                $('.purchaseTypeInTable').html("Способ оплаты: "+ purchaseType);   <!-- out new purchase type in table for customer -->
             },
            error: function () {
                console.log ("Failed");
            }
        });
    })
JS;
    $this->registerJs($purchaseTypeJS);
    ?>


    <div class="contactInformation col-12 col-lg-4">    <!-- Form for mail sending -->
        <h4>КОНТАКТНАЯ ИНФОРМАЦИЯ</h4>
        <?php $messageData = Yii::$app->session->getFlash('customerMessage') ?> <!-- $customerMessage {   0 => $orderNumber,  1 => "contactFormSubmitted" -->
        <?php if ($messageData[1] === "contactFormSubmitted"): ?>
            <div class="alert alert-success">
                <?php echo "Номер Вашего заказа: " . $messageData[0] . "\n"; ?>
                Благодарим Вас за обращение к нам. Мы ответим Вам как можно скорее.
            </div>
        <?php else: ?>
            <div class="row">
                <div class="contactInformation col-lg-12">
                    <?php $form = ActiveForm::begin(['id' => 'my-contact', 'enableClientScript' => false]); ?> <!-- Add "'enableClientScript' => false" for         -->
                                                                                                               <!--    disable jquery library including second time -->
                        <?= $form->field($model, 'name', ['enableLabel' => false])->textInput(array('placeholder' => 'Ваше имя', 'class'=>'form-control text-center')) ?>
                        <?= $form->field($model, 'email', ['enableLabel' => false])->textInput(['placeholder' => 'Email', 'class'=>'form-control text-center']) ?>
                        <?= $form->field($model, 'phone', ['enableLabel' => false])->textInput(['placeholder' => 'Ваш номер телефона', 'class'=>'form-control text-center']) ?>
                        <?= $form->field($model, 'body', ['enableLabel' => false])->textarea(['rows' => 3, 'placeholder' => 'Коментарии к заказу', 'class'=>'form-control text-center']) ?>
                        <?= $form->field($model, 'code', ['enableLabel' => false])->textInput(['placeholder' => 'Введите промокод (при наличии)', 'id' => 'PromoCodeID', 'class'=>'promoCode form-control text-center']) ?>

                    <label class="discountOut"></label>

                        <?= $form->field($model, 'reCaptcha', ['enableLabel' => false])->widget(ReCaptcha2::className(),
                            [   'siteKey' => '6Lc-VKYZAAAAADMXy0se_2qRN6t442GoV8aHBrVS', // V2 for FW0308.loc
//                            [    'siteKey' => '6Le5gagZAAAAAC0iqMNpb1G7GcAZjqOsO-arp8jP', // V2 for designburoshtor.website
                            ]
                        ) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Подтвердите заказ', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>



        <?php       // processing the entered promo code
        $promoCodeJS = <<<JS

        $('.promoCode').change(function() {
          let promoCodeJS = document.getElementById('PromoCodeID').value;
          let totalPrice = Number(document.getElementById('totalPrice').innerHTML);
          
          $.ajax({
               url: '/cart/promocode',
                data: {promoCodeJS: promoCodeJS},
                type: 'POST',
                success: function (discount) {
                   if (Number(discount) !== 0){                               <!-- out information about promo code validation -->
                        $('.discountOut').html("Ваша скидка " + discount + "%");
                        $('.totalPriceDescription').html("Стоимость заказа с учетом " + discount + "% скидки:");
                        $('#totalPrice').html(totalPrice - totalPrice*discount);
                   } else {
                       $('.discountOut').html("Ваш промокод неверный.");
                   }
                 },
                error: function () {
                    console.log ("Failed");
                }          
          });
        })
        
JS;
        $this->registerJs($promoCodeJS);
        ?>


</div>


