<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Special;
use yii\web\UploadedFile;

/**
 * SpecialSearch represents the model behind the search form of `common\models\Special`.
 */
class SpecialSearch extends Special
{
    public $cruisesList;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'image_id', 'procent'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['info', 'from', 'to','cruisesList'], 'safe'],
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
        $query = Special::find();
        $query->with('cruises');
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
            'name' => $this->name,
            'image_id' => $this->image_id,
            'procent' => $this->procent,
            'from' => $this->from,
            'to' => $this->to,
        ]);

        $query->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
