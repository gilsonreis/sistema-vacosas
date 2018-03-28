<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vacosas`.
 * Has foreign keys to the tables:
 *
 * - `tipos`
 * - `users`
 */
class m171007_163435_create_vacosas_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vacosas', [
            'id' => $this->primaryKey()->unsigned(),
            'nome' => $this->string()->notNull(),
            'tipo_id' => $this->integer()->notNull()->unsigned(),
            'descricao' => $this->text(),
            'valor' => $this->decimal(10,2),
            'url' => $this->string(),
            'responsavel_id' => $this->integer()->notNull()->unsigned(),
            'status'=> $this->smallInteger(1)->notNull()->defaultValue(false)->comment("usar: 0 para inativo, 1 para ativo, 2 para finalizado"),
            'create_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `tipo_id`
        $this->createIndex(
            'idx-vacosas-tipo_id',
            'vacosas',
            'tipo_id'
        );

        // add foreign key for table `tipos`
        $this->addForeignKey(
            'fk-vacosas-tipo_id',
            'vacosas',
            'tipo_id',
            'tipos',
            'id',
            'CASCADE'
        );

        // creates index for column `responsavel_id`
        $this->createIndex(
            'idx-vacosas-responsavel_id',
            'vacosas',
            'responsavel_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-vacosas-responsavel_id',
            'vacosas',
            'responsavel_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `tipos`
        $this->dropForeignKey(
            'fk-vacosas-tipo_id',
            'vacosas'
        );

        // drops index for column `tipo_id`
        $this->dropIndex(
            'idx-vacosas-tipo_id',
            'vacosas'
        );

        // drops foreign key for table `users`
        $this->dropForeignKey(
            'fk-vacosas-responsavel_id',
            'vacosas'
        );

        // drops index for column `responsavel_id`
        $this->dropIndex(
            'idx-vacosas-responsavel_id',
            'vacosas'
        );

        $this->dropTable('vacosas');
    }
}
