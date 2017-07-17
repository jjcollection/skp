<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IndikatorNilai;

/**
 * IndikatorNilaiSearch represents the model behind the search form about `app\models\IndikatorNilai`.
 */
class IndikatorNilaiSearch extends IndikatorNilai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idIndikatorNilai', 'idFormulirMaster', 'idIndikator'], 'integer'],
            [['nilai'], 'number'],
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
        $query = IndikatorNilai::find();

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
            'idIndikatorNilai' => $this->idIndikatorNilai,
            'idFormulirMaster' => $this->idFormulirMaster,
            'idIndikator' => $this->idIndikator,
            'nilai' => $this->nilai,
        ]);

        return $dataProvider;
    }
}
