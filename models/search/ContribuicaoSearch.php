<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contribuicao;

/**
 * ContribuicaoSearch represents the model behind the search form about `app\models\Contribuicao`.
 */
class ContribuicaoSearch extends Contribuicao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contribuinte_id', 'vacosa_id', 'comprovado'], 'integer'],
            [['valor'], 'number'],
            [['comprovante', 'create_at', 'update_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Contribuicao::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'contribuinte_id' => $this->contribuinte_id,
            'vacosa_id' => $this->vacosa_id,
            'valor' => $this->valor,
            'comprovado' => $this->comprovado,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'comprovante', $this->comprovante]);

        return $dataProvider;
    }
}
