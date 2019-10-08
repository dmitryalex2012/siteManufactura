<?php

/* @var $this yii\web\View */
/* @var $pillows array */
/* @var $linens array */

/* @var $productsEnding array */

use yii\helpers\Html;
use app\common\components\MyHelpers;



$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;

$productsEnding = new MyHelpers();
?>

<?php $cart = $items ?>
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
                            <td class="text-center"><?= $item['title']; ?></td>
                            <td class="text-center"><?= $item['quantity']; ?></td>
                            <td class="text-center"><?= $item['price']; ?></td>
                            <td class="text-center"><?= $item['price'] * $item['quantity']; ?></td>
                        </tr>
                        <?php $amount += $item['price'] * $item['quantity']; ?>
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
