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

<?//=
//Html::a(Html::img($product->address, ['width'=>"100%", 'height'=>"100%"]));
//?>
<!--<button class="buyBtn" value="--><?php //echo $item->number; ?><!--">Купить</button>-->

<?php
    if (strpos($product->address, ',') == true) {           //  is presented ONE photo of product in DB or MORE?
        $photoArray = explode(",", $product->address);  // >1 photo
        $photoQuantity = count($photoArray);
    } else {
        $photoQuantity = 1;                                        // 1 photo
        $photoArray = $product->address;
    }
?>

<div class="products">
        <div class="row">
            <div class="col-0 col-md-1">
            </div>
            <div class="col-12 col-md-5">
                <div id="carouselExampleInterval<?php echo $product->id; ?>" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php for ($i = 0; $i < $photoQuantity; $i++): ?>
                            <li data-target="#carouselExampleIndicators1<?php echo $product->id; ?>"
                                data-slide-to="<?php echo $i; ?>"
                                <?php if ($i === 0) { ?> class="active" <?php } ?> >
                            </li>
                        <?php endfor; ?>
                    </ol>

                    <div class="carousel-inner">
                        <?php   $temp = $photoArray; ?>
                        <?php if ($photoQuantity === 1): ?>
                                <div class="carousel-item active">              <!-- when only 1 photo of the product -->
                                    <img src="<?php echo $photoArray; ?>" class="d-block w-100" alt="...">
                                </div>
                       <?php else: ?>
                       <?php     for ($i = 0; $i < $photoQuantity; $i++) : ?>   <!-- when > 1 photo of the product -->
                                    <div class="carousel-item <?php if ($i == 0) { echo "active"; }  ?> " data-interval="1000000">
                                        <img src="<?php echo $temp[$i]; ?>" class="d-block w-100" alt="...">
                                    </div>
                       <?php     endfor; ?>
                       <?php endif; ?>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleInterval<?php echo $product->id; ?>"
                       role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval<?php echo $product->id; ?>"
                       role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>

            <div class="col-12 col-md-5">
                <div class="detailDescription">
                    <p class="detailProductTitle"><?php echo $product->content; ?></p>
                    <p class="detailProductDescription"><?php echo $product->description; ?></p>
                    <?php
                    if (isset($product->size)){
                        echo '<p class="detailProductSize">Размер полотенца: ' . $product->size . '</p>';
                    }
                    ?>
                    <p class="detailProductPrice"><?php echo "Цена: " . $product->price . " грн"; ?></p>
                    <button class="buyBtnDetail" value="<?php echo $product->number; ?>">Купить</button>
                </div>
            </div>
            <div class="col-0 col-md-1">
            </div>
        </div>
</div>


<?php
$js = <<<JS
    $('.buyBtnDetail').on('click', function() {
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

<script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o"
        crossorigin="anonymous"></script>

