<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Deck;

/**
 * DeckSearch represents the model behind the search form of `common\models\Deck`.
 */
class DeckSearch extends Deck
{

    public $shipName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'number', 'image_id', 'ship_id'], 'integer'],
            [['name', 'description', 'shipName'], 'safe'],
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
        $query = Deck::find();
        // add conditions that should always apply here
        $query->with('ship');
        $this->load($params);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'number' => $this->number,
            'image_id' => $this->image_id,
            'ship_id' => $this->ship_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);
        if ($this->shipName)
            $query->joinWith(['ship' => function ($q) {
                $q->where('ship.name LIKE "%' . $this->shipName . '%"');
            }]);

        return $dataProvider;
    }
}
