<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Unsur;

/**
 * UnsurSearch represents the model behind the search form about `app\models\Unsur`.
 */
class UnsurSearch extends Unsur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdUnsur', 'IdJenisUnsur'], 'integer'],
            [['NamaUnsur'], 'safe'],
            [['Nilai'], 'number'],
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
        $query = Unsur::find();

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
            'IdUnsur' => $this->IdUnsur,
            'Nilai' => $this->Nilai,
            'IdJenisUnsur' => $this->IdJenisUnsur,
        ]);

        $query->andFilterWhere(['like', 'NamaUnsur', $this->NamaUnsur]);

        return $dataProvider;
    }
}
