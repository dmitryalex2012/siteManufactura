<?php

use yii\db\Migration;

/**
 * Class m190807_163913_users
 */
class m190807_163913_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'pass' => $this->string()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string(),
            'status' => $this->integer(3)->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('user');
    }
}
