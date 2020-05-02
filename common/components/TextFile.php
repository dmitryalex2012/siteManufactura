<?php

namespace app\common\components;

class TextFile
{
    public function newPost()
    {
        $text = "Доставка по тарифам Новой Почты. Стоимость доставки по Киеву от 18 и от 35грн – по Украине
        Бесплатная доставка при заказе от 1000грн!";
        return ($text);
    }

    public function courier()
    {
        $text = "Доставка только по Киеву. Стоимость: от 50 до 100грн.";
        return ($text);
    }

    public function pickup()
    {
        $text = "Забрать товар Вы можете с понедельника по суботу с 9:00 по 20:00 часов.";
        return ($text);
    }

}


