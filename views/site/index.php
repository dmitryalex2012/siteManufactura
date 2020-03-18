<body class="home">
<?php
use yii\helpers\Html;
?>

<?php
/* @var $ourOffers object */
echo $ourOffers;
?>


<?php foreach ($ourOffers as $key=>$ourOffer):
    if ((((++$i) % 2) == 1)):
?>
    <div class="row">
        <?php endif; ?>
    <div class="card text-white col-12 col-lg-6">
        <img src="<?php echo $ourOffer->imageURL; ?>" class="card-img" alt="100%">
        <div class="card-img-overlay">
            <p class="pInIndex"><?php echo $ourOffer->inscription; ?></p>
<!--            --><?php //  if ($i > 2) {   echo Html::a($ourOffer->buttonText, '/products/pillows', ['class'=>'indexBtn btn btn-outline-info']);   } ?>
            <?php   if ($i > 2) {   echo Html::a($ourOffer->buttonText, $ourOffer->redirect, ['class'=>'indexBtn btn btn-outline-info']);   } ?>
        </div>
    </div>
<?php if ((($i % 2) == 0)): ?>
    </div>
<?php endif; ?>
<?php endforeach;
if (($i % 2) != 0)    { echo  "</div>";    }            // it's necessary to close "row" by "/div" when "col" are odd
?>
