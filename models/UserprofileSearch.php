<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Userprofile;

/**
 * UserprofileSearch represents the model behind the search form of `app\models\Userprofile`.
 */
class UserprofileSearch extends Userprofile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pk_id', 'fk_t_blood_id', 'fk_t_civilStatus_id', 'fk_t_home_id', 'fk_t_transport_id', 'fk_t_smoker_id', 'fk_t_drinker_id', 'fk_t_gender_id', 'fk_t_employee_id', 'fk_address_id', 'childNumber'], 'integer'],
            [['name', 'lastname', 'idCard', 'livesAlone', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = Userprofile::find();

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
            'fk_t_blood_id' => $this->fk_t_blood_id,
            'fk_t_civilStatus_id' => $this->fk_t_civilStatus_id,
            'fk_t_home_id' => $this->fk_t_home_id,
            'fk_t_transport_id' => $this->fk_t_transport_id,
            'fk_t_smoker_id' => $this->fk_t_smoker_id,
            'fk_t_drinker_id' => $this->fk_t_drinker_id,
            'fk_t_gender_id' => $this->fk_t_gender_id,
            'fk_t_employee_id' => $this->fk_t_employee_id,
            'fk_address_id' => $this->fk_address_id,
            'childNumber' => $this->childNumber,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'idCard', $this->idCard])
            ->andFilterWhere(['like', 'livesAlone', $this->livesAlone])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
