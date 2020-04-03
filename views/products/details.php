<?php

/* @var $this yii\web\View */
/* @var $product object */

/* @var $temp string */
/* @var $i float */


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

<?//=
//Html::a(Html::img($product->address, ['width'=>"100%", 'height'=>"100%"]));
//?>

<!--<button class="buyBtn" value="--><?php //echo $item->number; ?><!--">Купить</button>-->




<div class="products">
<!--    --><?php //foreach ($items as $key => $item): ?>
        <div class="row">

            <div class="col-12 col-sm-5">
<!--                <h3>--><?php //echo $item->title; ?><!--</h3>-->

<!--                <div id="carouselExampleInterval--><?php //echo $item->id; ?><!--" class="carousel slide" data-ride="carousel">-->
                <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
<!--                        --><?php //for ($i = 0; $i < $item->quantity; $i++): ?>
<!--                            <li data-target="#carouselExampleIndicators1--><?php //echo $item->id; ?><!--"-->
<!--                                data-slide-to="--><?php //echo $i; ?><!--" --><?php //if ($i === 0) {
//                                $b++; ?><!-- class="active" --><?php //} ?>
<!--                            </li>-->
<!--                        --><?php //endfor; ?>
                    </ol>

                    <div class="carousel-inner">
<!--                        --><?php //$temp = $item->notes; ?>
<!--                        --><?php //for ($i = 0; $i < $item->quantity; $i++): ?>
                            <div class="carousel-item <?php if ($i === 0) { ?> active <?php } ?>"
                                 data-interval="1000000">
<!--                                <img src="/--><?php //echo stristr($temp, ',', true); ?><!--" class="d-block w-100">-->
<!--                                --><?php //$temp = stristr($temp, ',');
//                                $temp = substr($temp, 1);
//                                ?>
                                <?= Html::a(Html::img($product->address, ['width'=>"100%", 'height'=>"100%"])); ?>
                            </div>
<!--                        --><?php //endfor; ?>
                    </div>

<!--                    <a class="carousel-control-prev" href="#carouselExampleInterval--><?php //echo $item->id; ?><!--"-->
                    <a class="carousel-control-prev" href="#carouselExampleInterval"
                       role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
<!--                    <a class="carousel-control-next" href="#carouselExampleInterval--><?php //echo $item->id; ?><!--"-->
                    <a class="carousel-control-next" href="#carouselExampleInterval"
                       role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>

            <div class="col-12 col-sm-7">
                <div class="worksDescription">
<!--                    --><?php //$temp = $item->content;
//                    while (strpos($temp, '*') > 0) :
//                        ?>
<!--                        <p>--><?php
//                            echo stristr($temp, '*', true);
//                            $temp = stristr($temp, '*');
//                            $temp = substr($temp, 1);
//                            ?>
<!--                        </p>-->
<!--                    --><?php //endwhile; ?>
                </div>

<!--                <button class="buyBtn" value="--><?php //echo $item->number; ?><!--">Купить</button>-->
                <button class="buyBtn">Купить</button>

            </div>

        </div>
<!--    --><?php //endforeach; ?>
</div>











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


<script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o"
        crossorigin="anonymous"></script>