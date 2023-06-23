<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Review;

/**
 * ReviewSearch represents the model behind the search form of `common\models\Review`.
 */
class ReviewSearch extends Review
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'user_id', 'cruise_id', 'ship_id', 'region_id', 'gallery_id', 'service', 'ship', 'ofice', 'programms', 'food'], 'integer'],
            [['title', 'description','userName','cruiseName','shipName','regionName'], 'safe'],
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
        $query = Review::find();

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
            'user_id' => $this->user_id,
            'cruise_id' => $this->cruise_id,
            'ship_id' => $this->ship_id,
            'region_id' => $this->region_id,
            'gallery_id' => $this->gallery_id,
            'service' => $this->service,
            'ship' => $this->ship,
            'ofice' => $this->ofice,
            'programms' => $this->programms,
            'food' => $this->food,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
