<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Company;

/**
 * CompanySearch represents the model behind the search form of `app\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'company_group_id', 'image_id', 'gallery_id', 'meta_id'], 'integer'],
            [['name', 'preview', 'detail', 'penalty_info', 'ship_info', 'currency'], 'safe'],
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
    public function search($params, $group=null)
    {
        $query = Company::find();
        $query->with(['companyGroup']);
        $query->with(['companyType']);
        $query->with(['image']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->attributes ($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if($group>0) {
            $this->company_group_id = $group;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'company_group_id' => $this->company_group_id,
            'image_id' => $this->image_id,
            'gallery_id' => $this->gallery_id,
            'meta_id' => $this->meta_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'penalty_info', $this->penalty_info])
            ->andFilterWhere(['like', 'ship_info', $this->ship_info])
            ->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
