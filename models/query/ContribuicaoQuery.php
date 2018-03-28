<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Contribuicao]].
 *
 * @see \app\models\Contribuicao
 */
class ContribuicaoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Contribuicao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Contribuicao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getSomaContribuicoes($id_vacosa)
    {
        $vacas = $this->where(['vacosa_id' => $id_vacosa])->all();
        $total = .0;
        foreach ($vacas as $vaca) {
            $total += $vaca->valor;
        }

        return $total;
    }
}
