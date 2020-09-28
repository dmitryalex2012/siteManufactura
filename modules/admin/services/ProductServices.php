<?php
namespace app\modules\admin\services;

use app\modules\admin\models\Products;
use Yii;

class ProductServices
{
    /**
     * Get product string by ID
     *
     * @param $productID
     *
     * @return mixed
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function getProductStringByID($productID)
    {
        return Products::findProductStringByID($productID);
    }

    /**
     * Write coped string to SESSION
     *
     * @param $productID
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function saveCopedString($productID)
    {
        $copedString = $this->getProductStringByID($productID);

        $session = Yii::$app->session;
        $session->set('copedString', $copedString);

        return;
    }

    public function outCopedString()
    {
        $session = Yii::$app->session;
        $copedString = $session->get('copedString');

        // object $copedString to array $copedString
        $copedString = (array)$copedString;
        // take only $copedString[0]
        $copedString = $copedString[array_keys($copedString)[1]];
        // convert $copedString to JSON with Cyrillic UTF-8 (it works with russian font)
        $copedString = json_encode($copedString, JSON_UNESCAPED_UNICODE);

        return $copedString;
    }


}