<?php

namespace app\common\components;

/* @var $this yii\web\View */
/* @var $pillows array */

/* @var $linens array */

class MyHelpers
{
    public static function productsEnding($quantity)
    {
        $quantity = $quantity % 100;
        if ($quantity>=11 && $quantity<=19) {
            $ending="ТОВАРОВ";
        } else  {
            $i = $quantity % 10;
            switch ($i) {
                case (1): $ending = "ТОВАР"; break;
                case (2): case (3): case (4): $ending = "ТОВАРА"; break;
                default: $ending="ТОВАРОВ";
            }
        }
        return ($ending);
    }
}


