<?php

use yii\db\Migration;

class m171012_023724_alter_users_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('users', 'role_name', 'varchar(30)');
    }

    public function safeDown()
    {
        $this->dropColumn('users', 'role_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171012_023724_alter_users_table cannot be reverted.\n";

        return false;
    }
    */
}
