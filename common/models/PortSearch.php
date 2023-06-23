<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Port;

/**
 * PortSearch represents the model behind the search form of `app\models\Port`.
 */
class PortSearch extends Port
{
    public $regionName;
    public $countryName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'region_id', 'country_id', 'meta_id', 'check'], 'integer'],
            [['name', 'name_en', 'info', 'excursion', 'regionName', 'countryName', 'places', 'coords'], 'safe'],
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
        $query = Port::find();
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'check'=>SORT_ASC,
                    'region_id'=>SORT_ASC,
                    'country_id'=>SORT_ASC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // $this->addCondition($query, 'region_id');
        // $dataProvider->sort->check =
        // grid filtering conditions
        $query->andFilterWhere([
            'port.ID' => $this->ID,
            // 'country_id' => $this->country_id,
            'port.meta_id' => $this->meta_id,
            'port.check' => $this->check,
        ]);

        $query->andFilterWhere(['like', 'port.name', $this->name])
              ->andFilterWhere(['like', 'port.name_en', $this->name_en])
              ->andFilterWhere(['like', 'port.info', $this->info])
              ->andFilterWhere(['like', 'port.excursion', $this->excursion])
//            ->andFilterWhere(['like', 'check', $this->check])
              ->andFilterWhere(['like', 'port.places', $this->places]);
        if($this->regionName)
            $query->joinWith(['region' => function ($q) {
                $q->where('region.name LIKE "%' . $this->regionName . '%"');
            }]);
//        $query->joinWith(['country' => function ($q) {
//            $q->where('country.name LIKE "%' . $this->countryName . '%"');
//        }]);
        // print $query->createCommand()->getRawSql();
        return $dataProvider;
    }
}