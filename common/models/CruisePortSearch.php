<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CruisePort;

/**
 * CruisePortSearch represents the model behind the search form of `app\models\CruisePort`.
 */
class CruisePortSearch extends CruisePort
{
    public $portName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'port_id', 'cruise_id', 'day'], 'integer'],
            [['arrival', 'departure', 'info', 'date','portName'], 'safe'],
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
        $query = CruisePort::find();

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
//        $query->andFilterWhere([
//            'ID' => $this->ID,
//            'port_id' => $this->port_id,
//            'cruise_id' => $this->cruise_id,
//            'arrival' => $this->arrival,
//            'departure' => $this->departure,
//            'date' => $this->date,
//            'day' => $this->day,
//        ]);

        $query->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
