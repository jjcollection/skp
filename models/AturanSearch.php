<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aturan;

/**
 * AturanSearch represents the model behind the search form about `app\models\Aturan`.
 */
class AturanSearch extends Aturan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdAturan', 'IdGolongan', 'IdKriteria'], 'integer'],
            [['AK'], 'number'],
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
        $query = Aturan::find();

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
            'IdAturan' => $this->IdAturan,
            'IdGolongan' => $this->IdGolongan,
            'IdKriteria' => $this->IdKriteria,
            'AK' => $this->AK,
        ]);

        return $dataProvider;
    }
}
