<?php

/* @var $this yii\web\View */
/* @var $pillows array */
/* @var $linens array */

/* @var $myTemp array */

/* @var $productsEnding array */

use yii\helpers\Html;
use app\common\components\MyHelpers;



$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;

$productsEnding = new MyHelpers();
?>

<?php //  echo '<pre>';
//        print_r($items);
//        echo '</pre>';
//?>

<?php $cart = $items; ?>
<h2>В КОРЗИНЕ - <? echo count($cart) . " " . $productsEnding->productsEnding(count($cart)); ?></h2>
<br>

    <div class="cartTable row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <?php if (!empty($cart)): ?>
                <?php $amount = 0; ?>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">Наименование</th>
                        <th class="text-center">Количество</th>
                        <th class="text-center">Цена, грн</th>
                        <th class="text-center">Сумма, грн.</th>
                    </tr>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td class="text-center"><?= $item['title'] . " (код товара " . $item['number'] . ") "; ?></td>
                            <td class="text-center"><?= $item['count']; ?></td>
                            <td class="text-center"><?= $item['amount']; ?></td>
                            <td class="text-center"><?= $item['amount'] * $item['count']; ?></td>
                        </tr>
                        <?php $amount += $item['amount'] * $item['count']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-right">Итого:</td>
                        <td class="text-center"><?= $amount; ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <p>Ваша корзина пуста</p>
            <?php endif; ?>
        </div>
        <div class="col-sm-1"></div>
</div>
