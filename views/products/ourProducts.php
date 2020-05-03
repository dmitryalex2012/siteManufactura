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
        <div class="row listProduct">               <!-- product cards is arranged in 3 columns on page -->
    <?php endif; ?>
    <div class="col-12 col-md-4 col-xl-4">
        <div class="card">
            <div class="card-body">

                <?php       // photo address example: foto/ourworks/livingRoom1.jpg,foto/ourworks/livingRoom2.jpg,...
                if (strpos($item->address, ',') == true){     //  is presented ONE photo of product in DB or MORE?
                $productURL = strstr($item->address, ',', true);   // more then 1 photo
                } else {                                                               // 1 photo
                    $productURL = $item->address;
                }
                ?>
                <?= Html::a(Html::img($productURL, ['width'=>"100%", 'height'=>"100%"]), ['products/detail', 'productID' => $item->number]); ?>

                <p class="card-text"><?php echo $item->content; ?></p>
                <div id="boxProduct">
                    <div class="priceProduct">
                        <?php echo $item->price; ?> грн.
                    </div>
                    <div class="buyProduct">
                        <button class="buyBtn" value="<?php echo $item->number; ?>">Купить</button>  <!-- "value" is used for JS (below) -->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php if ((($i % 3) == 0)): ?>
        </div>                                  <!-- 3 products is displayed in line  -->
    <?php endif; ?>
<?php endforeach;
if (($i % 3) != 0)    { echo  "</div>";    }    // it's necessary to close "row" by "/div" when "col" are odd or
?>                                           <!--  products < 3 pieces


<?php                   // adding product to cart and output products total quantity near inscription "Cart" in HEADER
$js = <<<JS
    $('.buyBtn').on('click', function() {
        $.ajax({
            url: '/cart/add',
            data: {productID: $(this).attr('value')},
            type: 'POST',
            success: function (totalQuantity) {
                $('.classCart').html("Корзина "+totalQuantity);
            },
            error: function () {
                console.log ("Fail");
            }
        });
    });
JS;
$this->registerJs($js);
?>


