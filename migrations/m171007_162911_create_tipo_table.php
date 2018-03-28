<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tipo`.
 */
class m171007_162911_create_tipo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tipos', [
            'id' => $this->primaryKey()->unsigned(),
            'nome' => $this->string()->notNull(),
            'create_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);


        $tipos = [
            'Script PHP',
            'Admin Template',
            'Mobile App',
            'Tema Wordpress',
            'Site Template'
        ];

        foreach ($tipos as $tipo) {
            $this->insert('tipos', ['nome' => $tipo]);
        }

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tipo');
    }
}
