<?php
namespace app\modules\admin\services;

use app\modules\admin\models\Products;
use Yii;

class ProductServices
{
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

    public function outCopedString()
    {
        $session = Yii::$app->session;
        $copedString = json_encode($session->get('copedString'));
//        $copedString = $session->get('copedString');

//        $copedString = $session->get('copedString');
//        $copedString = json_decode(json_encode($copedString), true);;

        return $copedString;
    }


}