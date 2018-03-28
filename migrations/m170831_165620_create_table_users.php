<?php

use yii\db\Migration;

class m170831_165620_create_table_users extends Migration
{
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(60)->notNull(),
            'email' => $this->string(130)->notNull(),
            'username' => $this->string(32)->notNull(),
            'password' => $this->string(150)->notNull(),
            'auth_key' => $this->string(150)->notNull(),
            'photo' => $this->string(250)->defaultValue('no-picture.png'),
            'status' => $this->boolean()->defaultValue(false),
            'last_login' => $this->dateTime(),
            'create_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $user = [
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => true,
            'last_login' => date('Y-m-d H:i:s')
        ];

        $this->insert('users', $user);

    }

    public function safeDown()
    {
        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170831_165620_create_table_users cannot be reverted.\n";

        return false;
    }
    */
}
