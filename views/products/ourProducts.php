<?php

/* @var $this yii\web\View */
/* @var $pillows array */
/* @var $linens array */

?>

<?php $i = 0;
foreach ($pillows as $pillow):
    if ((((++$i) % 4) == 1)): ?>
        <div class="row listProduct">
    <?php endif; ?>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
<!--                <h5 class="card-title">Специальный заголовок</h5>-->
                <img src="/<?php echo $pillow->address; ?>" class="card-img-top" alt="100%">
                <p class="card-text"><?php echo $pillow->content; ?></p>
                <div id="boxProduct">
                    <div class="priceProduct">
                        <?php echo $pillow->price; ?> грн.
                    </div>
                    <div class="buyProduct">
                        <a href="#" class="btn btn-primary">Купить</a>
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


