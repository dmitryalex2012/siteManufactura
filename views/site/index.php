<body class="home">
<?php
use yii\helpers\Html;
?>

<?php
/* @var $ourOffers object */
?>

<br>
<?php $i = 0; ?>

<?php foreach ($ourOffers as $key=>$ourOffer):
    if ((((++$i) % 2) == 1)):                   //  output cards in 2 columns
?>
    <div class="row">
    <?php endif; ?>
        <div class="card text-white col-12 col-lg-6">
            <img src="<?php echo $ourOffer->imageURL; ?>" class="card-img" alt="100%">
            <div class="card-img-overlay">
                <p class="pInIndex">    <?php   echo $ourOffer->inscription; ?> </p>

                <?php   if ($i == 1): ?>  <!-- "inscription2" will appear only for first card (this is inscription in bottom of the card) -->
                    <p class="pInIndexAdd"> <?php echo $ourOffer->inscription2; ?> </p>
                <?php   endif;  ?>

                <!-- the button in the bottom of the card will appear from second card-->
                <?php   if ($i > 1) {   echo Html::a($ourOffer->buttonText, ['/products/list', 'value' => $ourOffer->redirect], ['class'=>'indexBtn btn btn-outline-info']);   } ?>
            </div>
        </div>
<?php if ((($i % 2) == 0)): ?>
    </div>                                      <!-- close "row" (after each 2 columns) -->
<?php endif; ?>
<?php endforeach;
if (($i % 2) != 0)     { echo  "</div>";    }   // it's necessary to close "row" by "/div" when "col" are odd
?>
