<?php

/* @var $this yii\web\View */
/* @var $pillows array */
/* @var $linens array */
/* @var $totalQuantity float */

/* @var $myTemp array */

/* @var $productsEnding array */

use yii\helpers\Html;
use app\common\components\MyHelpers;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;

$productsEnding = new MyHelpers();
?>

<?php
//    echo '<br>';
//?>
<?php //  echo '<pre>';
//        print_r($items);
//        echo '</pre>';
//?>

<?php $cart = $items; ?>
<!--<h2>В КОРЗИНЕ - --><?// echo count($cart) . " " . $productsEnding->productsEnding(count($cart)); ?><!--</h2>-->
<!--<h2>В КОРЗИНЕ - --><?// echo count($cart) . " " . $productsEnding->productsEnding(count($cart)); ?><!--</h2>-->
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
                        <tr>
                            <td><?= $item['title']; ?></td>
                            <td><?= $item['number']; ?></td>
                            <td>
                                <select class="quantityAjax">
                                    <?php for ($i=1; $i<=10; $i++): ?>
                                    <option value="<?php echo ($item['number']) . "***" . $i; ?>"
                                      <?php if ($item['quantity'] == $i) echo "selected" ?> >
                                        <? echo $i ?>
                                    </option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <td><?= $item['price']; ?></td>
                            <td class="<?php echo $item['number']; ?>"><?= $item['price'] * $item['quantity']; ?></td>
<!--                            <td class="--><?php //echo $item['number']; ?><!--">--><?//= $item['number']; ?><!--</td>-->
                        </tr>
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


<!--<p class=".price" value = "123">555</p>-->
<!--<label class=".price">ABC</label>-->

<?php
$script1 = <<<JS
    $('.quantityAjax').change(function() {
        var productData = $(this).val();
        var classType ="." + productData.substr(0, 4);      // change price selected product
        var totalPrice = document.getElementById('totalPrice').abbr;
         $.ajax({
            url: '/cart/change',
            data: {productData: productData},
            dataType : 'json',
            type: 'POST',
            success: function (newPrice) {              // array ("0"=>price, "1"=>difference)
                $(classType).html(Math.abs(newPrice[0]));
                $('#totalPrice').html(Number(totalPrice)+Number(newPrice[1]));
                totalPriceClass = document.querySelector("#totalPrice");
                totalPriceClass.setAttribute('abbr', String(Number(totalPrice)+Number(newPrice[1])));
             },
            error: function () {
                console.log ("Failed");            //  NEED !!!!!!!!!!  better delete???????
            }
        });
    });
JS;
$this->registerJs($script1);
?>

