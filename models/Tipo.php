<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos".
 *
 * @property integer $id
 * @property string $nome
 * @property string $create_at
 * @property string $update_at
 *
 * @property Vacosas[] $vacosas
 */
class Tipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['create_at', 'update_at'], 'safe'],
            [['nome'], 'string', 'max' => 255],
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
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacosas()
    {
        return $this->hasMany(Vacosas::className(), ['tipo_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\TipoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TipoQuery(get_called_class());
    }
}
