<?php

namespace app\common\components;

class Temp
{
    public $tempPublic = "public properties";
    private $tempPrivate = "private properties";
    protected $tempProtected = "protected properties";

    public static function myTemp()
    {
        $text = "Доставка 1000грн!";
        return ($text);
    }
}


