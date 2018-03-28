<?php

use yii\db\Migration;

class m171015_021340_addBaseRolesPermissions extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $contribuinte = $auth->createRole("Contribuinte");
        $auth->add($contribuinte);

        $administrador = $auth->createRole('Administrador');
        $auth->add($administrador);
        $auth->addChild($administrador, $contribuinte);

        $permissoes = [
            'vacosa' => [
                'create',
                'update',
                'index',
                'delete',
                'listar-vacosas',
                'contribuir',
                'view'
            ],
            'tipos' => [
                'create',
                'update',
                'index',
                'delete',
                'view'
            ],
            'contribuicoes' => [
                'create',
                'update',
                'index',
                'delete',
                'view'
            ],
            'usuarios' => [
                'create',
                'update',
                'index',
                'delete',
                'view'
            ],
            'permissoes' => [
                'gerenciar-permissoes'
            ]
        ];

        foreach ($permissoes as $k => $v) {
            foreach ($v as $v2) {
                $item = $auth->createPermission($k . "/" . $v2);
                $auth->add($item);
            }
        }
    }

    public function safeDown()
    {
        echo "m171015_021340_addBaseRolesPermissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171015_021340_addBaseRolesPermissions cannot be reverted.\n";

        return false;
    }
    */
}
