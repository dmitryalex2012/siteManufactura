<?php

use yii\db\Migration;

/**
 * Class m200225_120034_OurOffers
 */
class m200225_120034_OurOffers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ourOffers', [
            'id' => $this->primaryKey(),
            'imageURL' => $this->string(),
            'inscription' => $this->string(),
            'buttonText' => $this->string(),
            'note' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        echo "m200225_120034_OurOffers cannot be reverted.\n";

        return false;
    }

}
