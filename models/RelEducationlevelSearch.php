<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RelEducationlevel;

/**
 * RelEducationlevelSearch represents the model behind the search form of `app\models\RelEducationlevel`.
 */
class RelEducationlevelSearch extends RelEducationlevel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pk_id', 'fk_userprofile_id', 'fk_educationLevel_id', 'fk_educationStatus_id'], 'integer'],
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
        $query = RelEducationlevel::find();

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
            'fk_userprofile_id' => $this->fk_userprofile_id,
            'fk_educationLevel_id' => $this->fk_educationLevel_id,
            'fk_educationStatus_id' => $this->fk_educationStatus_id,
        ]);

        return $dataProvider;
    }
}
