<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacosas".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $tipo_id
 * @property string $descricao
 * @property string $valor
 * @property string $url
 * @property integer $responsavel_id
 * @property integer $status
 * @property string $create_at
 * @property string $update_at
 *
 * @property Contribuicoes[] $contribuicoes
 * @property Users $responsavel
 * @property Tipos $tipo
 */
class Vacosa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacosas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'tipo_id', 'responsavel_id', 'tipo_id', 'valor', 'url'], 'required'],
            [['tipo_id', 'responsavel_id', 'status'], 'integer'],
            [['descricao'], 'string'],
            [['valor'], 'number'],
            [['create_at', 'update_at'], 'safe'],
            [['nome', 'url'], 'string', 'max' => 255],
            [['responsavel_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['responsavel_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['tipo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'tipo_id' => Yii::t('app', 'Tipo'),
            'descricao' => Yii::t('app', 'Descrição'),
            'valor' => Yii::t('app', 'Valor'),
            'url' => Yii::t('app', 'Url'),
            'responsavel_id' => Yii::t('app', 'Responsável'),
            'status' => Yii::t('app', 'Status'),
            'create_at' => Yii::t('app', 'Criado em'),
            'update_at' => Yii::t('app', 'Alterado em'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContribuicoes()
    {
        return $this->hasMany(Contribuicao::className(), ['vacosa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsavel()
    {
        return $this->hasOne(User::className(), ['id' => 'responsavel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Tipo::className(), ['id' => 'tipo_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\VacosasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\VacosasQuery(get_called_class());
    }
}
