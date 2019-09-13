<?php

use yii\db\Migration;

/**
 * Class m190913_150510_services
 */
class m190913_150510_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('services', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->string(),
            'notes' => $this->string(),
        ]);
    }

     public function safeDown()
    {
        echo "m190913_150510_services cannot be reverted.\n";

        return false;
    }
}
