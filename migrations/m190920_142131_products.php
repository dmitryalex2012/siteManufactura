<?php

use yii\db\Migration;

/**
 * Class m190920_142131_products
 */
class m190920_142131_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'categories' => $this->string(),
            'title' => $this->string(),
            'address' => $this->string(),
            'content' => $this->string(),
            'number' => $this->integer(10)->Null(),
            'price' => $this->integer(10)->Null(),
        ]);
    }

    public function safeDown()
    {
        echo "m190920_142131_products cannot be reverted.\n";

        return false;
    }
}
