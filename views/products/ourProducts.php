<?php

/* @var $this yii\web\View */
/* @var $pillows array */

/* @var $linens array */

use yii\helpers\Html;

foreach ($items as $key => $item) {
    $name = $item->categoriesBredCrumbs;
    break;
}
$this->params['breadcrumbs'][] = $this->title = 'Магазин ' . $name;

?>


<?php $i = 0;
foreach ($items as $item):
    if ((((++$i) % 3) == 1)): ?>
        <div class="row listProduct">
    <?php endif; ?>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <img src="/<?php echo $item->address; ?>" class="card-img-top" alt="100%">
                <p class="card-text"><?php echo $item->content; ?></p>
                <div id="boxProduct">
                    <div class="priceProduct">
                        <?php echo $item->price; ?> грн.
                    </div>
                    <div class="buyProduct">
                        <button class="buyBtn" value="<?php echo $item->number; ?>">Купить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ((($i % 3) == 0)): ?>
        </div>
    <?php endif; ?>
<?php endforeach;
if (($i % 3) != 0)    { echo  "</div>";    }            // it's necessary to close "row" by "/div" when "col" are odd
?>


<?php
$js = <<<JS
    $('.buyBtn').on('click', function() {
        $.ajax({
            url: '/cart/add',
            data: {productID: $(this).attr('value')},
            type: 'POST',
            success: function (totalQuantity) {
                $('.classCart').html("Корзина "+totalQuantity);
                console.log(totalQuantity);
            },
            error: function () {
                console.log ("Fail");
            }
        });
    });
JS;
$this->registerJs($js);
?>


