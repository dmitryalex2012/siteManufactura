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


<?//= Html::a('Temp', ['/cart/tempadd'], ['class' => 'btn btn-primary']) ?>
<?//= Html::a('Temp', ['/cart/out'], ['class' => 'btn btn-primary']) ?>


<?php $i = 0;
foreach ($items as $item):
    if ((((++$i) % 4) == 1)): ?>
        <div class="row listProduct">
    <?php endif; ?>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <!--                <h5 class="card-title">Специальный заголовок</h5>-->
                <img src="/<?php echo $item->address; ?>" class="card-img-top" alt="100%">
                <p class="card-text"><?php echo $item->content; ?></p>
                <div id="boxProduct">
                    <div class="priceProduct">
                        <?php echo $item->price; ?> грн.
                    </div>
                    <div class="buyProduct">
                        <!--                        <a href="#" class="btn btn-primary">Купить</a>-->
                        <!--                        --><? //= Html::button('Купить', ['class' => 'teaser'])
                        ?>

<!--                        --><?//= Html::a('Купить', ['/products/addcart'], ['class' => 'btn btn-primary']) ?>
                        <button class="buyBtn" value="<?php echo $item->number; ?>">Купить</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ((($i % 4) == 0)): ?>
    </div>
<?php endif; ?>
<?php endforeach;
if ((($i % 4) != 0)):
    ?>
    </div>
<?php endif; ?>



<!--<button class="btn btn-success">Temp</button>-->
<?php
//$temp = <<<JS
//    $(document).ready(function() {
//         $.ajax({
//            url: '/cart/temp',
//            // data: {productData: productData},
//            dataType : 'json',
//            type: 'POST',
//            success: function (totalQuantity) {              // array ("0"=>price, "1"=>difference)
//                console.log(totalQuantity);
//             },
//            error: function () {
//                console.log ("Failed");            //  NEED !!!!!!!!!!  better delete???????
//            }
//        })
//    });
//JS;
//$this->registerJs($temp);
//?>



<?php
$onLoad = <<<JS
    $(document).ready(function() {
         $.ajax({
            url: '/cart/total',
            // data: {productData: productData},
            // dataType : 'json',
            type: 'POST',
            success: function (totalQuantity) {              // array ("0"=>price, "1"=>difference)
                $('.aaa').html("Корзина "+totalQuantity);
                console.log(totalQuantity);
             },
            error: function () {
                console.log ("Failed");            //  NEED !!!!!!!!!!  better delete???????
            }
        })   
    });
JS;
$this->registerJs($onLoad);
?>

<?php
$js = <<<JS
    $('.buyBtn').on('click', function() {
        // let temp = 1;
        $.ajax({
            url: '/cart/add',
            data: {productID: $(this).attr('value')},
            type: 'POST',
            success: function (totalQuantity) {
                console.log(totalQuantity);
                $('.aaa').html("Корзина "+totalQuantity);
            },
            error: function () {
                console.log ("Fail");
            }
        });
    });
JS;
$this->registerJs($js);
?>


