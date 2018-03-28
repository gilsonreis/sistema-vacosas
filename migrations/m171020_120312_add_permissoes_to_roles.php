<?php

use yii\db\Migration;

class m171020_120312_add_permissoes_to_roles extends Migration
{
    public function safeUp()
    {
        $permissoes = [
            'Administrador' => [
                'contribuicoes/create',
                'contribuicoes/delete',
                'contribuicoes/index',
                'contribuicoes/update',
                'contribuicoes/view',
                'permissoes/gerenciar-permissoes',
                'tipos/create',
                'tipos/delete',
                'tipos/index',
                'tipos/update',
                'tipos/view',
                'usuarios/create',
                'usuarios/delete',
                'usuarios/index',
                'usuarios/update',
                'usuarios/view',
                'vacosa/contribuir',
                'vacosa/create',
                'vacosa/delete',
                'vacosa/index',
                'vacosa/listar-vacosas',
                'vacosa/update',
                'vacosa/view'
            ],
            'Contribuinte' => [
                'contribuicoes/create',
                'contribuicoes/index',
                'vacosa/contribuir',
                'vacosa/create',
                'vacosa/listar-vacosas'
            ]
        ];

        foreach ($permissoes as $k => $v) {
            foreach ($v as $v2) {
                $this->insert('auth_item_child', [
                    'parent' => $k,
                    'child' => $v2
                ]);
            }
        }

        $this->insert('auth_assignment', ['item_name' => "Administrador", 'user_id' => 1]);

    }

    public function safeDown()
    {
        $this->truncateTable('auth_item_child');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171020_120312_add_permissoes_to_roles cannot be reverted.\n";

        return false;
    }
    */
}
