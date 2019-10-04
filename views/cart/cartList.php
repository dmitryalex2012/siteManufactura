<?php

/* @var $this yii\web\View */
/* @var $pillows array */

/* @var $linens array */

use yii\helpers\Html;




use common\components\MyHelpers;




$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;



echo MyHelpers::myGlobalToDoSomethingAwesome();



?>

<h2>В КОРЗИНЕ - <? echo count($items) ?> товар
    <? if ((count($items) >= 2)) {
        if ((count($items) <= 4)) {
            echo "а";
        } else {
            echo "ов";
        }
    } ?>
</h2>

<?php foreach ($items as $item):
    ?>
    <div>
        <? echo $item->id; ?>
        <? echo $item->title; ?>
        <br>
    </div>
<?php
endforeach;
?>

