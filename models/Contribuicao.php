<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contribuicoes".
 *
 * @property integer $id
 * @property integer $contribuinte_id
 * @property integer $vacosa_id
 * @property string $valor
 * @property string $comprovante
 * @property integer $comprovado
 * @property string $create_at
 * @property string $update_at
 *
 * @property Users $contribuinte
 * @property Vacosas $vacosa
 */
class Contribuicao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contribuicoes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contribuinte_id', 'vacosa_id', 'valor'], 'required'],
            [['contribuinte_id', 'vacosa_id', 'comprovado'], 'integer'],
            [['valor'], 'number'],
            [['create_at', 'update_at'], 'safe'],
            [['comprovante'], 'string', 'max' => 255],
            [['contribuinte_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['contribuinte_id' => 'id']],
            [['vacosa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacosa::className(), 'targetAttribute' => ['vacosa_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contribuinte_id' => Yii::t('app', 'Contribuinte'),
            'vacosa_id' => Yii::t('app', 'Vacosa'),
            'valor' => Yii::t('app', 'Valor'),
            'comprovante' => Yii::t('app', 'Comprovante'),
            'comprovado' => Yii::t('app', 'Comprovado'),
            'create_at' => Yii::t('app', 'Criado em'),
            'update_at' => Yii::t('app', 'Alterado em'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContribuinte()
    {
        return $this->hasOne(User::className(), ['id' => 'contribuinte_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacosa()
    {
        return $this->hasOne(Vacosa::className(), ['id' => 'vacosa_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\ContribuicaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ContribuicaoQuery(get_called_class());
    }
}
