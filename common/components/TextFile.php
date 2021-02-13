<?php

namespace app\common\components;

class TextFile
{
    /**
     * Returns text with description of the "New Post" delivery.
     *
     * @return string
     */
    public function newPost()
    {
        $text = "Доставка по тарифам Новой Почты. Стоимость доставки по Киеву от 18 и от 35грн – по Украине
        Бесплатная доставка при заказе от 1000грн!";

        return $text;
    }


    /**
     * Returns text with description of the courier delivery.
     *
     * @return string
     */
    public function courier()
    {
        $text = "Доставка только по Киеву. Стоимость: от 50 до 100грн.";

        return $text;
    }

    /**
     * Returns text with description of the self delivery.
     *
     * @return string
     */
    public function pickup()
    {
        $text = "Забрать товар Вы можете с понедельника по суботу с 9:00 по 20:00 часов.";

        return $text;
    }

}


