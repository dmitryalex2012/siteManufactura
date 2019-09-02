<?php
///* @var $title string */
///* @var $countTotal string */
///* @var $notes string */
?>

<div class="products">
    <?php foreach ($items as $key => $item): ?>
    <div class="row">
        <div class="col-12 col-sm-5">
            <h3>Device-<?php echo $item->id; ?></h3>
            <img src="/<?php echo $item->notes; ?>" width="100%" class="col-10"><br>
        </div>
        <div class="col-12 col-sm-7">
            <p> Width: 1m <br> High: 2m <br> Weight 5kg<br></p>
            <a href="<?php echo \yii\helpers\Url::to(['/buy/presentation', 'singerId'=>$item->id]) ?>">
                <button type="button" class="btn btn-outline-success">Buy</button>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<!--<script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>-->

