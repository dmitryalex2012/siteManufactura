<?php

/* @var $this yii\web\View */
/* @var $pillows array */

/* @var $linens array */

use yii\helpers\Html;

//foreach ($items as $key => $item) {
//    $name = $item->categoriesBredCrumbs;
//    break;
//}
//$this->params['breadcrumbs'][] = $this->title = 'Магазин ' . $name;
$this->params['breadcrumbs'][] = $this->title = 'Магазин ' . $items;

?>




<!--<button class="buyBtn" value="--><?php //echo $item->number; ?><!--">Купить</button>-->

<?php
//$js = <<<JS
//    $('.buyBtn').on('click', function() {
//        $.ajax({
//            url: '/cart/add',
//            data: {productID: $(this).attr('value')},
//            type: 'POST',
//            success: function (totalQuantity) {
//                $('.classCart').html("Корзина "+totalQuantity);
//                console.log(totalQuantity);
//            },
//            error: function () {
//                console.log ("Fail");
//            }
//        });
//    });
//JS;
//$this->registerJs($js);
//?>


