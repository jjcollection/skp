<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pegawai;

/**
 * PegawaiSearch represents the model behind the search form about `app\models\Pegawai`.
 */
class PegawaiSearch extends Pegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NoPegawai', 'idGolongan', 'IdJabatan', 'PejabatPenilai', 'IdUser'], 'integer'],
            [['Nip', 'Nama', 'Agama', 'Telp', 'Alamat', 'UnitKerja'], 'safe'],
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
        $query = Pegawai::find();

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
            'NoPegawai' => $this->NoPegawai,
            'idGolongan' => $this->idGolongan,
            'IdJabatan' => $this->IdJabatan,
            'PejabatPenilai' => $this->PejabatPenilai,
            'IdUser' => $this->IdUser,
        ]);

        $query->andFilterWhere(['like', 'Nip', $this->Nip])
            ->andFilterWhere(['like', 'Nama', $this->Nama])
            ->andFilterWhere(['like', 'Agama', $this->Agama])
            ->andFilterWhere(['like', 'Telp', $this->Telp])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'UnitKerja', $this->UnitKerja]);

        return $dataProvider;
    }
}
