<?php
namespace app\modules\services;

use app\modules\admin\models\Products;
use Yii;

class ProductServices
{
    /**
     * Write coped string to SESSION
     *
     * @param $productID
     */
    public function saveCopedString($productID)
    {
        $copedString = $this->getProductStringByID($productID);

        $session = Yii::$app->session;
        $session->set('copedString', $copedString);

        return;
    }

    /**
     *Get product string by ID
     *
     * @param $productID
     *
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getProductStringByID($productID)
    {
        return Products::findProductStringByID($productID);
    }


}