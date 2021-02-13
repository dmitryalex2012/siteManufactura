<?php

namespace app\common\components;

class MyHelpers
{
    /**
     * Makes end of the "product" word. The end of word depends from products quantity.
     *
     * @param $quantity
     * @return string
     */
    public static function productsEnding($quantity)
    {
        $quantity = $quantity % 100;            //  cart contains less 100 items products (in this case)
        if ($quantity>=11 && $quantity<=19) {
            $ending="ТОВАРОВ";
        } else  {
            switch ($quantity % 10) {
                case (1): $ending = "ТОВАР"; break;
                case (2): case (3): case (4): $ending = "ТОВАРА"; break;
                default: $ending="ТОВАРОВ";
            }
        }
        return ($ending);
    }
}


