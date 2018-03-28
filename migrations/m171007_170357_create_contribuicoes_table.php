<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contribuicoes`.
 * Has foreign keys to the tables:
 *
 * - `users`
 * - `vacosas`
 */
class m171007_170357_create_contribuicoes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('contribuicoes', [
            'id' => $this->primaryKey()->unsigned(),
            'contribuinte_id' => $this->integer()->notNull()->unsigned(),
            'vacosa_id' => $this->integer()->notNull()->unsigned(),
            'valor' => $this->decimal(10,2),
            'comprovante' => $this->string(),
            'comprovado' => $this->boolean()->defaultValue(false),
            'create_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `contribuinte_id`
        $this->createIndex(
            'idx-contribuicoes-contribuinte_id',
            'contribuicoes',
            'contribuinte_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-contribuicoes-contribuinte_id',
            'contribuicoes',
            'contribuinte_id',
            'users',
            'id',
            'CASCADE'
        );

        // creates index for column `vacosa_id`
        $this->createIndex(
            'idx-contribuicoes-vacosa_id',
            'contribuicoes',
            'vacosa_id'
        );

        // add foreign key for table `vacosas`
        $this->addForeignKey(
            'fk-contribuicoes-vacosa_id',
            'contribuicoes',
            'vacosa_id',
            'vacosas',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `users`
        $this->dropForeignKey(
            'fk-contribuicoes-contribuinte_id',
            'contribuicoes'
        );

        // drops index for column `contribuinte_id`
        $this->dropIndex(
            'idx-contribuicoes-contribuinte_id',
            'contribuicoes'
        );

        // drops foreign key for table `vacosas`
        $this->dropForeignKey(
            'fk-contribuicoes-vacosa_id',
            'contribuicoes'
        );

        // drops index for column `vacosa_id`
        $this->dropIndex(
            'idx-contribuicoes-vacosa_id',
            'contribuicoes'
        );

        $this->dropTable('contribuicoes');
    }
}
