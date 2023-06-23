<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cabin;

/**
 * CabinSearch represents the model behind the search form of `app\models\Cabin`.
 */
class CabinSearch extends Cabin
{
    public $shipName;
    public $cabinLocName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'ship_id', 'capacity', 'image_id', 'gallery_id', 'cabin_loc_id'], 'integer'],
            [['name', 'code', 'shipName', 'info', 'cabinLocName'], 'safe'],
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
        $query = Cabin::find();
//        $query->with(['ship']);
//        $query->with(['image']);
//        $query->with(['cabinLoc']);
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
            'cabin.ID' => $this->ID,
            'cabin.ship_id' => $this->ship_id,
            'capacity' => $this->capacity,
            'cabin.image_id' => $this->image_id,
            'cabin.gallery_id' => $this->gallery_id,
            'cabin.cabin_loc_id' => $this->cabin_loc_id,
        ]);

        $query->andFilterWhere(['like', 'cabin.name', $this->name])
            ->andFilterWhere(['like', 'cabin.code', $this->code]);
        if($this->shipName)
        $query->joinWith(['ship' => function ($q) {
            $q->where('ship.name LIKE "%' . $this->shipName . '%"');
        }]);
        if($this->cabinLocName)
        $query->joinWith(['cabinLoc' => function ($q) {
            $q->where('cabin_loc.name LIKE "%' . $this->cabinLocName . '%"');
        }]);

        return $dataProvider;
    }
}
