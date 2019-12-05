<?php

/* @var $this yii\web\View */
/* @var $pillows array */
/* @var $linens array */

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
<h2>В КОРЗИНЕ - <? echo count($cart) . " " . $productsEnding->productsEnding(count($cart)); ?></h2>
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
                            <td class="price<?php echo $item['number'];?>"><?= $item['price'] * $item['quantity']; ?></td>
                        </tr>
                        <?php $price += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-right">Итого:</td>
                        <td class="totalPrice"><?= $price; ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <div class="cartStatus"> <p>Ваша корзина пуста</p> </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-1"></div>
</div>

<!--<p id="productID" value = "123">555</p>-->

<?php
$script1 = <<<JS
    $('.quantityAjax').change(function() {
        var productData = $(this).val();
                            var cl = ".price";
        $.ajax({
            url: '/cart/change',
            data: {productData: productData},
                    // dataType : 'json',
            type: 'POST',
            success: function (aaa) {
                console.log(aaa);
                            console.log(cl);
                            $('cl').html(aaa);
                // $('cl').html(aaa);
                // $('.totalPrice').html(aaa);
            },
            error: function () {
                console.log ("Failed");            //  NEED !!!!!!!!!!  better delete???????
            }
        });
    });
JS;
$this->registerJs($script1);
?>

