<?php

use yii\db\Migration;

/**
 * Class m190807_110258_addresses
 */
class m190807_110258_singer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('singer', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->string(),
            'description' => $this->string(),
            'notes' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('singer');
    }
}
