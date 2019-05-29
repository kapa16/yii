<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190525_104901_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->notNull()->unique(),
            'password' => $this->string(),
            'name' => $this->string(),
            'last_name' => $this->string(),
            'auth_key' => $this->string(32),
            'email' => $this->string(),
            'created_at' => $this->datetime()->defaultValue(date('Y-m-d H:i:s')),
            'updated_at' => $this->datetime(),
        ]);

        $this->createIndex('username_idx', '{{%users}}', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
