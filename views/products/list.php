<?php
///* @var $title string */
///* @var $countTotal string */
///* @var $notes string */
?>

<div class="products">
    <div class="row">
        <div class="col-12 col-sm-2">
            <div class="sidebar">
                <ul>
                    <li><a href="#">Laptop</a></li>
                    <li><a href="#">Phones</a></li>
                    <li><a href="#">Memory</a></li>
                    <li><a href="#">Videocards</a></li>
                </ul>
            </div>
        </div>


        <div class="col-12 col-sm-10">
            <?php $i = 0;
            foreach ($items as $key => $item):
                if ((((++$i) % 4) == 1)): ?>
                    <div class="row">
                <?php endif; ?>
                <div class="col-12 col-sm-6 col-md-3 text-center shadow-lg">
                    <h3>Device-<?php echo $item->id; ?></h3>
                    <img src="/<?php echo $item->notes; ?>" width="100%" class="col-10"><br>
                    <p> Width: 1m <br> High: 2m <br> Weight 5kg<br></p>
                    <a href="<?php echo \yii\helpers\Url::to(['/buy/presentation', 'singerId'=>$item->id]) ?>">
                        <button type="button" class="btn btn-outline-success">Buy</button>
                    </a>
                </div>
                <?php if ((($i % 4) == 0)): ?>
                </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--<script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>-->

