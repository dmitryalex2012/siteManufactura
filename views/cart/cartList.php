<?php

/* @var $this yii\web\View */
/* @var $pillows array */
/* @var $linens array */

use yii\helpers\Html;

?>

<h2>Cart</h2>

<?php foreach ($items as $item ):
?>
    <div>
        <? echo $item->title; ?>
        <br>
    </div>
<?php
    endforeach;
?>

