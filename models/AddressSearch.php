<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Address;

/**
 * AddressSearch represents the model behind the search form of `app\models\Address`.
 */
class AddressSearch extends Address
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pk_id', 'fk_region_id', 'fk_city_id'], 'integer'],
            [['streetType', 'streetNumber', 'streetChar', 'streetCardinal', 'intersectionNumber', 'intersectionChar', 'intersectionCardinal', 'buildingNumber', 'complement', 'details'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Address::find();

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
            'pk_id' => $this->pk_id,
            'fk_region_id' => $this->fk_region_id,
            'fk_city_id' => $this->fk_city_id,
        ]);

        $query->andFilterWhere(['like', 'streetType', $this->streetType])
            ->andFilterWhere(['like', 'streetNumber', $this->streetNumber])
            ->andFilterWhere(['like', 'streetChar', $this->streetChar])
            ->andFilterWhere(['like', 'streetCardinal', $this->streetCardinal])
            ->andFilterWhere(['like', 'intersectionNumber', $this->intersectionNumber])
            ->andFilterWhere(['like', 'intersectionChar', $this->intersectionChar])
            ->andFilterWhere(['like', 'intersectionCardinal', $this->intersectionCardinal])
            ->andFilterWhere(['like', 'buildingNumber', $this->buildingNumber])
            ->andFilterWhere(['like', 'complement', $this->complement])
            ->andFilterWhere(['like', 'details', $this->details]);

        return $dataProvider;
    }
}
