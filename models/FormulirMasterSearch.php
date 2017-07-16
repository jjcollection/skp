<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * FormulirMasterSearch represents the model behind the search form about `app\models\FormulirMaster`.
 */
class FormulirMasterSearch extends FormulirMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idFormulirMaster', 'idUser'], 'integer'],
            [['tanggalBuat', 'tahun'], 'safe'],
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
        $query = FormulirMaster::find();

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
            'idFormulirMaster' => $this->idFormulirMaster,
            'tanggalBuat' => $this->tanggalBuat,
            'idUser' => Yii::$app->user->getId(),
        ]);

        $query->andFilterWhere(['like', 'tahun', $this->tahun]);

        return $dataProvider;
    }
    
    public function searchkasek($params)
    {
        $query = FormulirMaster::find();

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
            'idFormulirMaster' => $this->idFormulirMaster,
            'tanggalBuat' => $this->tanggalBuat,
        ]);

        $query->andFilterWhere(['like', 'tahun', $this->tahun]);

        return $dataProvider;
    }
}
