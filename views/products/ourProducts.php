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


<button class="btn btn-success" id="study">Купить</button>
<!--<script>-->
<?php
//https://www.youtube.com/watch?reload=9&v=vDLhSVChvJ0&list=PL9XdPIVgBVVmYWGF3BFZwHu4Fz9fa6GJd&index=7
$js = <<<JS
    $('#study').on('click', function() {
        $.ajax({
            url: '/products/sample',
            data: {test: '123'},
            type: 'GET',
            success: function (mytemp) {
                console.log ("OK!!!!!!!!!!!!!!!!");
                console.log(mytemp);
            },
            error: function () {
                console.log ("Fail");
            }
        });
    });
JS;
$this->registerJs($js);
?>

<!--<input id="clickMe" type="button" value="Купить" onclick="MyFunc();" />-->
<!--<input id="clickMe" type="button" value="clickme" onclick="MyFunc();" />-->
<!-- </script>-->




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

                        <?= Html::a('Купить', ['/products/addcart'], ['class' => 'btn btn-primary']) ?>

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


