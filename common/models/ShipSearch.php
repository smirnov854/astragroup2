<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ship;

/**
 * ShipSearch represents the model behind the search form of `app\models\Ship`.
 * @property Image $image
 */


class ShipSearch extends Ship
{
    public $companyName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'type_id', 'company_id', 'image_id', 'gallery_id', 'meta_id'], 'integer'],
            [['name', 'code', 'preview', 'detail', 'info', 'cabin_info', 'food_info', 'Entertainment_Info', 'companyName'], 'safe'],
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
        $query = Ship::find();
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
            'type_id' => $this->type_id,
            'company_id' => $this->company_id,
            'image_id' => $this->image_id,
            'gallery_id' => $this->gallery_id,
            'meta_id' => $this->meta_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'cabin_info', $this->cabin_info])
            ->andFilterWhere(['like', 'food_info', $this->food_info])
            ->andFilterWhere(['like', 'Entertainment_Info', $this->Entertainment_Info]);
        if($this->companyName)
        $query->joinWith(['company' => function ($q) {
            $q->where('company.name LIKE "%' . $this->companyName . '%"');
        }]);


        return $dataProvider;
    }
}
