<?php

namespace app\models;

use app\models\Formulir;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FormulirSearch represents the model behind the search form about `app\models\Formulir`.
 */
class FormulirSearch extends Formulir
{
    /**
     * @inheritdoc
     */
    
    public $NamaUnsur;


    public function rules()
    {
        return [
            [['IdFormulir', 'Kuantitas', 'Mutu', 'IdUnsur'], 'integer'],
            [['Output','NamaUnsur'], 'safe'],
            [['Waktu', 'Biaya', 'AK'], 'number'],
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
        $query = Formulir::find();
       
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['idUnsur']);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
           
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'IdFormulir' => $this->IdFormulir,
            'Kuantitas' => $this->Kuantitas,
            'Mutu' => $this->Mutu,
            'Waktu' => $this->Waktu,
            'Biaya' => $this->Biaya,
            'AK' => $this->AK,
        ]);

        $query->andFilterWhere(['like', 'Output', $this->Output]);
        return $dataProvider;
    }
    
//    public function searchPenunjang($params)
//    {
//        $query = Formulir::find();
//       // $query->joinWith('idUnsur');
//        // add conditions that should always apply here
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            return $dataProvider;
//        }
//
//        // grid filtering conditions
//        $query->andFilterWhere([
//            'IdFormulir' => $this->IdFormulir,
//            'IdUser' => Yii::$app->user->getId(),
//            'Kuantitas' => $this->Kuantitas,
//            'Mutu' => $this->Mutu,
//            'Waktu' => $this->Waktu,
//            'Biaya' => $this->Biaya,
//            'AK' => $this->AK,
//            //'Unsur.IdJenisUnsur'=>6,
//           
//        ]);
//
//        $query->andFilterWhere(['like', 'Output', $this->Output]);
//
//        return $dataProvider;
//    }
}
