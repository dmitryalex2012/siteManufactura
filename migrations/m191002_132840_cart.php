<?php

use yii\db\Migration;

/**
 * Class m191002_132840_cart
 */
class m191002_132840_cart extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'userLogin' => $this->string(),
            'userPassword' => $this->string(),
            'productID' => $this->integer(10)->Null(),
            'title' => $this->string(),
            'quantity' => $this->integer(10)->Null(),
            'price' => $this->integer(10)->Null(),
        ]);
    }

    public function safeDown()
    {
        echo "m191002_132840_cart cannot be reverted.\n";

        return false;
    }
}
