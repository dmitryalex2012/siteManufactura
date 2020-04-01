<?php

/* @var $this yii\web\View */
/* @var $product object */


use yii\helpers\Html;

switch ($product->categories){                                      // determine previous address for Bread Crumbs
    case 'pillow': $previousAddress = "/products/pillows"; break;
    case 'apero': $previousAddress = "/products/apero"; break;
    case 'linens': $previousAddress = "/products/linens"; break;
    case 'towel': $previousAddress = "/products/towels"; break;
    case 'baby': $previousAddress = "/products/baby"; break;
}
$this->params['breadcrumbs'][] = $this->title = array(
    'label'=> 'Магазин ' . $product->categoriesBredCrumbs,
    'url'=> $previousAddress
);
$this->params['breadcrumbs'][] = $product->content;

?>

<?=
Html::a(Html::img($product->address, ['width'=>"100%", 'height'=>"100%"]));
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


