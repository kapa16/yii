<?php

use Faker\Factory;
use yii\db\Migration;

/**
 * Class m190526_120026_insert_default_users
 */
class m190526_120026_insert_default_users extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $this->insert('{{%users}}', [
            'login' => 'admin',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.ru',
        ]);
        $this->insert('{{%users}}', [
            'login' => 'demo',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('demo'),
            'name' => 'demo',
            'last_name' => 'demo',
            'email' => 'demo@demo.ru',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%users}}', ['login' => 'admin']);
        $this->delete('{{%users}}', ['login' => 'demo']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_120026_insert_default_users cannot be reverted.\n";

        return false;
    }
    */
}
