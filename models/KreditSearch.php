<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kredit;

/**
 * KreditSearch represents the model behind the search form about `app\models\Kredit`.
 */
class KreditSearch extends Kredit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['No'], 'integer'],
            [['Kode', 'Kegiatan', 'Keterangan'], 'safe'],
            [['NIlai'], 'number'],
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
        $query = Kredit::find();

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
            'No' => $this->No,
            'NIlai' => $this->NIlai,
        ]);

        $query->andFilterWhere(['like', 'Kode', $this->Kode])
            ->andFilterWhere(['like', 'Kegiatan', $this->Kegiatan])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
