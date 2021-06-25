<?php

/* @var $this yii\web\View */
/* @var $product object */

$this->params['breadcrumbs'][] = $this->title = [
    'label'=> 'Магазин ' . $product->categoriesBredCrumbs,
    /** The 'value' is used in Controller for determination the type of product in PREVIOUS PAGE. */
    'url'=> ['/products/list', 'value' => $product->categories],
];
$this->params['breadcrumbs'][] = $product->content;

    /** The photo addresses is separated by the "," */
    if (strpos($product->address, ',') == true) {            //  Is presented ONE photo of product in DB or MORE?
        $photoArray = explode(",", $product->address);     // >1 photo. Make array with products photos addresses.
        $photoQuantity = count($photoArray);
    } else {
        $photoQuantity = 1;                                         // 1 photo
        $photoArray = $product->address;
    }
?>

<div class="products">
        <div class="row">
            <div class="col-0 col-md-1">
            </div>
            <div class="col-12 col-md-5">           <!-- column with product photos -->
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
                       <?php  for ($i = 0; $i < $photoQuantity; $i++) : ?>
                                <div class="carousel-item <?php if ($i == 0) { echo "active"; }  ?> " data-interval="1000000">
                                    <?php if ($photoQuantity === 1): ?>
                                        <img src="<?php echo $photoArray; ?>" class="d-block w-100" alt="...">
                                    <?php else: ?>
                                        <img src="<?php echo $photoArray[$i]; ?>" class="d-block w-100" alt="..."> <!-- > 1 product photo -->
                                    <?php endif; ?>
                                </div>
                       <?php  endfor; ?>
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

            <div class="col-12 col-md-5">                             <!-- column with product description -->
                <div class="detailDescription">
                    <?php
                    ?>
                    <h1 class="detailProductTitle"><?php echo $product->content; ?></h1>
                    <img src="<?php echo $product->color; ?>" class="detailColor" alt="">
                    <p class="detailProductDescription"><?php echo $product->description; ?></p>
                    <?php
                    if (isset($product->size)){
                        echo '<p class="detailProductSize">Размер изделия: ' . $product->size . '</p>';
                    }
                    ?>
                    <p class="detailProductPrice"><?php echo "Цена: " . $product->price . " грн"; ?></p>
                    <button class="buyBtnDetail" value="<?php echo $product->number; ?>">Купить</button>  <!-- "value" is used for JS -->
                </div>
            </div>
            <div class="col-0 col-md-1">
            </div>
        </div>
</div>

<?php                                                               // Add product to cart
$js = <<<JS
    $('.buyBtnDetail').on('click', function() {
        $.ajax({
            url: '/cart/add',
            data: {productID: $(this).attr('value')},
            type: 'POST',
            success: function (totalQuantity) {
                $('.classCart').html("Корзина "+totalQuantity);     <!-- Add quantity of the bought products near -->
            },                                                      <!--   inscription "Cart in HEADER" -->
            error: function () {
                console.log ("Fail");
            }
        });
    });
JS;
$this->registerJs($js);
?>


