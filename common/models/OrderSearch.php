<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'status_id', 'user_id', 'manager_id', 'cruise_id', 'cabin_id'], 'integer'],
            [['bookid', 'cabin'], 'safe'],
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
        $query = Order::find();

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
            'ID' => $this->ID,
            'status_id' => $this->status_id,
            'user_id' => $this->user_id,
            'manager_id' => $this->manager_id,
            'cruise_id' => $this->cruise_id,
            'cabin_id' => $this->cabin_id,
        ]);

        $query->andFilterWhere(['like', 'bookid', $this->bookid])
            ->andFilterWhere(['like', 'cabin', $this->cabin]);

        return $dataProvider;
    }
}
