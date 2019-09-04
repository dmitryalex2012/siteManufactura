<body class="works">

<?php
///* @var $title string */
///* @var $countTotal string */
///* @var $notes string */
/* @var $temp string */

?>

<div class="products">
    <?php foreach ($items as $key => $item): ?>
        <div class="row">
            <div class="col-12 col-sm-5">
                <h3><?php echo $item->title; ?></h3>
                <img src="/<?php echo $item->notes; ?>" width="100%" class="col-10"><br>
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

