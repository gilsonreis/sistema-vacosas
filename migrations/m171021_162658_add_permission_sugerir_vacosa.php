<?php

use yii\db\Migration;

class m171021_162658_add_permission_sugerir_vacosa extends Migration
{
    public function safeUp()
    {
        $this->insert('auth_item', ['name' => 'vacosa/sugerir-vacosa', 'type' => 2]);
        $this->insert('auth_item_child', ['parent' => 'Administrador', 'child' => 'vacosa/sugerir-vacosa']);
        $this->insert('auth_item_child', ['parent' => 'Contribuinte', 'child' => 'vacosa/sugerir-vacosa']);
    }

    public function safeDown()
    {
        echo "m171021_162658_add_permission_sugerir_vacosa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171021_162658_add_permission_sugerir_vacosa cannot be reverted.\n";

        return false;
    }
    */
}
