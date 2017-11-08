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
    public $idAspek;
    public function rules()
    {
        return [
            [['idIndikatorNilai', 'idFormulirMaster','idAspek', 'idIndikator'], 'integer'],
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
    public function searchPelayanan($params)
    {
        $query = IndikatorNilai::find()->join('INNER JOIN','indikator', 'indikator.idIndikator=indikator_nilai.idIndikator');

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
            'idAspek' => 1,
        ]);

        return $dataProvider;
    }
    public function searchIntegritas($params)
    {
        $query = IndikatorNilai::find()->join('INNER JOIN','indikator', 'indikator.idIndikator=indikator_nilai.idIndikator');

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
            'idAspek' => 2,
        ]);

        return $dataProvider;
    }
    public function searchKomitmen($params)
    {
        $query = IndikatorNilai::find()->join('INNER JOIN','indikator', 'indikator.idIndikator=indikator_nilai.idIndikator');

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
            'idAspek' => 3,
        ]);

        return $dataProvider;
    }
    public function searchDisiplin($params)
    {
        $query = IndikatorNilai::find()->join('INNER JOIN','indikator', 'indikator.idIndikator=indikator_nilai.idIndikator');

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
             'idAspek' => 4,
        ]);

        return $dataProvider;
    }
    
    public function searchKerjasama($params)
    {
        $query = IndikatorNilai::find()->join('INNER JOIN','indikator', 'indikator.idIndikator=indikator_nilai.idIndikator');

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
             'idAspek' => 5,
        ]);

        return $dataProvider;
    }
    public function searchKepemimpinan($params)
    {
        $query = IndikatorNilai::find()->join('INNER JOIN','indikator', 'indikator.idIndikator=indikator_nilai.idIndikator');

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
            'idAspek' => 6,
        ]);

        return $dataProvider;
    }
}
