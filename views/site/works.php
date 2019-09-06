<body class="works">

<?php

//use yii\bootstrap\BootstrapPluginAsset;

///* @var $title string */
///* @var $countTotal string */
///* @var $notes string */
/* @var $temp string */
/* @var $i float */

?>

<div class="products">
    <?php foreach ($items as $key => $item): ?>
        <div class="row">
            <div class="col-12 col-sm-5">
                <h3><?php echo $item->title; ?></h3>
<!--                <img src="/--><?php //echo $item->notes; ?><!--" width="100%" class="col-10"><br>-->

                <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php for ($i = 0; $i < $items->quantity; $i++): ?>
                        <li data-slide-to="<?php ($i - 1); ?>" <?php if ($i === 0) {?> class="active" <?php } ?>></li>
<!--                        <li data-slide-to="0" class="active"></li>-->
<!--                        <li data-slide-to="1"></li>-->
<!--                        <li data-slide-to="2"></li>-->
                        <?php endfor; ?>
                    </ol>
                    <div class="carousel-inner">

                        <?php $temp = $item->notes; ?>
                        <?php for ($i = 0; $i < 3; $i++): ?>
                        <div class="carousel-item <?php if ($i === 0) {?> active <?php } ?>" data-interval="200000">

<!--                            --><?php
//                            $temp = stristr($temp, ',', true);
//                            echo  $temp;
//                            ?>

                            <img src="/<?php stristr($temp, ',', true); ?>" class="d-block w-100">
                            <?php $temp = stristr($temp, ',');
                            $temp = substr($temp, 1);
                            ?>

                        </div>
                        <?php endfor; ?>

<!--                        <div class="carousel-item active" data-interval="200000">-->
<!--                            <img src="/foto/livingRoom.jpg" class="d-block w-100">-->
<!--                        </div>-->
<!--                        <div class="carousel-item" data-interval="200000">-->
<!--                            <img src="/foto/slipingRoom.jpg" class="d-block w-100">-->
<!--                        </div>-->
<!--                        <div class="carousel-item" data-interval="200000">-->
<!--                            <img src="/foto/childrenRoom.gif" class="d-block w-100">-->
<!--                        </div>-->
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-7">
                <div class="worksDescription">
                    <?php
                    $temp = $item->content;
                    while (strpos($temp, '*') > 0) :
                        ?>
                        <p><?php
                            echo stristr($temp, '*', true);
                            $temp = stristr($temp, '*');
                            $temp = substr($temp, 1);
                            ?>
                        </p>
                    <?php endwhile; ?>

                </div>
                <!--            <a href="-->
                <?php //echo \yii\helpers\Url::to(['/buy/presentation', 'singerId'=>$item->id]) ?><!--">-->
                <!--                <button type="button" class="btn btn-outline-success">Buy</button>-->
                <!--            </a>-->
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!--<script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>-->

