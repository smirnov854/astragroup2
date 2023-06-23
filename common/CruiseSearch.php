<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cruise;
use yii\helpers\ArrayHelper;

/**
 * CruiseSearch represents the model behind the search form of `app\models\Cruise`.
 */
class CruiseSearch extends Cruise
{

    public $regionName;
    public $itinerary;
    public $companyName;
    public $portName;
    public $shipName;
    public $check;
    public $typeId;
    public $leng_from;
    public $leng_to;
    public $date_from;
    public $date_to;
    public $price_from;
    public $price_to;

    public $types;
    public $regions;
    public $ports;
    public $countries;
    public $companies;
    public $ships;
    public $country_id;
    public $cntry_id;
    public $dep_ports;
    public $itn_ports;
    public $specials;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'region_id', 'company_id', 'country_id', 'ship_id', 'port_id', 'cruise_length', 'meta_id', 'leng_from', 'leng_to', 'cntry_id'], 'integer'],
            [['name', 'itinerary', 'departure_date', 'date_from', 'date_to', 'useful_info', 'update',
                'regionName', 'companyName', 'shipName', 'portName', 'typeId', 'check',
                'types', 'regions', 'ports', 'countries', 'companies', 'ships', 'dep_ports', 'itn_ports', 'specials'], 'safe'],
            [['min_price', 'price_from', 'price_to'], 'number'],
        ];
    }
//    public function formName()
//    {
//        return '';
//    }
    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function count($params) {
        $query = self::silver_query($params);
        return $query->count();
    }
    public function silver_query($params)
    {
        $query = Cruise::find();
        $query->with('meta');
        $query->with('ship');
        $query->with('ports');
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            return $query;
        }
        $query->andFilterWhere([
            'cruise.ID' => $this->ID,
            'cruise.region_id' => $this->region_id,
            'cruise.company_id' => $this->company_id,
            'cruise.ship_id' => $this->ship_id,
            'cruise.port_id' => $this->port_id,
            'departure_date' => $this->departure_date,
            'cruise_length' => $this->cruise_length,
            'min_price' => $this->min_price,
            'cruise.meta_id' => $this->meta_id,
        ]);
        if(!$this->port_id){
			$query->andFilterWhere(
				['>', 'cruise.port_id', 0]
			);
		}
        $query->andFilterWhere(['like', 'cruise.name', $this->name])
            ->andFilterWhere(['like', 'useful_info', $this->useful_info]);
        if ($this->regionName)
            $query->joinWith(['region' => function ($q) {
                $q->where('region.name LIKE "%' . $this->regionName . '%"');
            }]);
        if ($this->check === '0')
            $query->joinWith(['ports' => function ($q) {
                $q->where('port.check = ' . $this->check);
            }]);
        elseif ($this->check === '1') {
            $query->andWhere("`cruise`.`ID` not in (select `cruise_port`.`cruise_id` from `cruise_port` where `cruise_port`.`port_id` in (select ID from port where port.check = 0))");
        }
        if ($this->companyName)
            $query->joinWith(['company' => function ($q) {
                $q->where('company.name LIKE "%' . $this->companyName . '%"');
            }]);
        elseif ($this->typeId)
            $query->joinWith(['company' => function ($q) {
                $q->where('company.company_type_id = ' . $this->typeId);
            }]);
        if ($this->types) {
            $query->joinWith(['company' => function ($q) {
                $q->where('company.company_type_id in (' . implode(",", $this->types) . ")");
            }]);
        }
        if ($this->countries) {
            $query->joinWith(['ports p' => function ($q) {
                $q->where('p.country_id in (' . implode(",", $this->countries) . ")");
            }]);
        }
        if ($this->regions) {
            $query->joinWith(['regions' => function ($q) {
                $q->where('region.ID in (' . implode(",", $this->regions) . ")");
            }]);
        }
        if ($this->dep_ports) {
            $query->andFilterWhere(
                ['in', 'cruise.port_id', $this->dep_ports]
            );
        }
        if ($this->itn_ports) {
            $query->joinWith(['ports as aports' => function ($q) {
                $q->where('aports.ID in (' . implode(",", $this->itn_ports) . ")");
            }]);
        }
        if ($this->ships) {
            $query->andFilterWhere(
                ['in', 'ship_id', $this->ships]
            );
        }
        if ($this->companies) {
            $query->andFilterWhere(
                ['in', 'company_id', $this->companies]
            );
        }

//        if($this->companyTypeName)
//            $query->joinWith(
//                ['companyType'=>function($q){
//                    $q->where(['company_type.name like "%' . $this->companyTypeName . '%"']);
//                }]
//            );

        if ($this->shipName)
            $query->joinWith(['ship' => function ($q) {
                $q->where('ship.name LIKE "%' . $this->shipName . '%"');
            }]);
        if ($this->portName)
            $query->joinWith(['port' => function ($q) {
                $q->where('port.name LIKE "%' . $this->portName . '%"');
            }]);
        $query->distinct();
        if ($this->leng_to && $this->leng_to > 1) {
            $query->andFilterWhere(
                ['<=', 'cruise_length', (int)$this->leng_to-1]
            );
        }
        if ($this->leng_from ) {
            $query->andFilterWhere(
                ['>=', 'cruise_length', (int)($this->leng_from-1)]
            );
        }
        else {
            $query->andFilterWhere(
                ['>', 'cruise_length', 1]
            );
        }
        if ($this->date_to) {
            $query->andFilterWhere(
                ['<=', 'departure_date', (string)($this->date_to)]
            );
        }
        if ($this->date_from) {
            $query->andFilterWhere(
                ['>=', 'departure_date', (string)$this->date_from]
            );
        }
        else {
            $query->andFilterWhere(
                ['>', 'departure_date', date("Y-m-d")]
            );
        }
        if ($this->price_to ) {
            $query->andFilterWhere(
                ['<=', 'price_rub', (string)$this->price_to]
            );
        }
        if ($this->price_from && $this->price_from > 0) {
            $query->andFilterWhere(
                ['>=', 'price_rub', (string)$this->price_from]
            );
        }
        else {
            $query->andFilterWhere(
                ['>', 'price_rub', 0]
            );
        }
        $query->andFilterWhere(
            ['=', 'visible', 1]
        );
        $query->andFilterWhere(
            ['>=', 'updated', date("Y-m-d H:i:s",strtotime("-200 day"))]
        );
        if($this->specials) {
            $query->joinWith("special", true, "RIGHT JOIN");
//            if(!$query->count()){
//				$query2 = Cruise::find();
//				$query2->orderBy("min_price");
//				$query2->limit(20);
//				$query->union($query2);
//			}
        }

//        if($orderBy=)
//        $query->orderBy('departure_date','price_rub');
        return $query;
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
        $query = self::silver_query($params);
//		print $query->createCommand()->rawSql; die;
        // add conditions that should always apply  here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort'=>[
                'attributes' => [
                    'departure_date' => [
                        'asc' => ['departure_date' => SORT_ASC, 'price_rub' => SORT_ASC],
                        'desc' => ['price_rub' => SORT_ASC, 'departure_date' => SORT_ASC],
                        'default' => SORT_ASC,
                        'label' => 'по дате',
                    ],
                    'price_rub' => [
                        'asc' => ['price_rub' => SORT_ASC, 'departure_date' => SORT_ASC],
                        'desc' => ['departure_date' => SORT_ASC, 'price_rub' => SORT_ASC ],
                        'default' => SORT_ASC,
                        'label' => 'по цене',
                    ],
                ],
                'defaultOrder'=>[
                    'departure_date'=>SORT_ASC,
                    'price_rub' => SORT_ASC
                ]
            ]
        ]);
        return $dataProvider;
    }

    public function regions($params)
    {
        $selected = @$params["regions"];
        unset($params["regions"]);
        $regionssQuery = $this->silver_query($params);
        if($selected) {
            $regionssQuery->andWhere(["not in", "region.ID", $selected]);
        }
        $regionssQuery->joinWith("regions");
        $regionssQuery->select("region.ID")->distinct();
        $region_ids = ArrayHelper::toArray($regionssQuery->All(), [
            'ID',
        ]);
        $ar2 = ArrayHelper::map(Region::find()->select(["ID","name","company_type_id"])->where(["in","ID",$region_ids])->orderBy("name")->all(), "ID", "name", "company_type_id");
        if($selected) {
            $dopQuery=Region::find()->where(["IN","ID",$selected])->select("ID");
//            print $countrysQuery->createCommand()->rawSql;
            $select_ids = ArrayHelper::toArray($dopQuery->All(), [
                'ID',
            ]);
            $ar1 = ArrayHelper::map(Region::find()->select(["ID","name","company_type_id"])->where(["in","ID",$select_ids])->orderBy("name")->all(), "ID", "name", "company_type_id");
            $ar2 = ($ar1+$ar2);
        }

//         echo '<pre>';
//         print_r($ar2);
//         echo '</pre>';
// die();

        foreach($ar2 as $region_type_id => $region_type){
            // print_r($region_type_id);
            // print_r($region_type);
            // die();
            if (is_array($region_type) == true) {
                foreach($region_type as $region_id => $region) {
                    $result[$region_id] = $region."<span class='region-type' data-regionid='".$region_type_id."'></span>"; 
                }
            } else {
                $result = $ar2;
            }
        }
        
        // print_r($result);
        // echo '</pre>';

        return $result;
//        return ArrayHelper::map(Region::findAll($region_ids), "ID", "name");
    }
    public function companies($params)
    {
        $selected = @$params["companies"];
        unset($params["companies"]);
        $companiesQuery = $this->silver_query($params);
        if($selected) {
            $companiesQuery->andWhere(["not in", "cruise.company_id", $selected]);
        }
        $companiesQuery->select("cruise.company_id ID")->distinct();
        $company2_ids = ArrayHelper::toArray($companiesQuery->All(), [
            'ID',
        ]);
        $ar2 = ArrayHelper::map(Company::find()->select(["ID","name"])->where(["in","ID",$company2_ids])->orderBy("name")->all(), "ID", "name");
        if($selected) {
            $companiesQuerys=Company::find()->where(["IN","ID",$selected])->select("ID");
//            print $companiesQuerys->createCommand()->rawSql;
            $company1_ids = ArrayHelper::toArray($companiesQuerys->All(), [
                'ID',
            ]);
            $ar1 = ArrayHelper::map(Company::find()->select(["ID","name"])->where(["in","ID",$company1_ids])->orderBy("name")->all(), "ID", "name");
            $ar2 = ($ar1+$ar2);
        }
        return $ar2;
    }

    public function countries($params)
    {
        $selected = @$params["countries"];
        unset($params["countries"]);
        $countryQuery = $this->silver_query($params);
        if($selected) {
            $countryQuery->andWhere(["not in", "p.country_id", $selected]);
        }
        $countryQuery->joinWith("ports p");
        $countryQuery->select("p.country_id ID")->distinct();
        $country_ids = ArrayHelper::toArray($countryQuery->All(), [
            'ID',
        ]);
        $ar2 = ArrayHelper::map(Country::find()->select(["ID","name"])->where(["in","ID",$country_ids])->orderBy("name")->all(), "ID", "name");
        if($selected) {
            $countryQuerys=Country::find()->where(["IN","ID",$selected])->select("ID");
//            print $countrysQuery->createCommand()->rawSql;
            $country1_ids = ArrayHelper::toArray($countryQuerys->All(), [
                'ID',
            ]);
            $ar1 = ArrayHelper::map(Country::find()->select(["ID","name"])->where(["in","ID",$country1_ids])->orderBy("name")->all(), "ID", "name");
            $ar2 = ($ar1+$ar2);
        }
        return $ar2;
    }
    public function route_ports($params)
    {
        $selected = @$params["itn_ports"];
        unset($params["itn_ports"]);
        $portsQuery = $this->silver_query($params);
        if($selected) {
            $portsQuery->andWhere(["not in", "pcheck.ID", $selected]);
        }
        $portsQuery->joinWith("ports pcheck");
		$portsQuery->andWhere("pcheck.check = 1");
        $portsQuery->select("pcheck.ID")->distinct();
        $ports_ids = ArrayHelper::toArray($portsQuery->All(), [
            'ID',
        ]);
        $ar2 = ArrayHelper::map(Port::find()->select(["ID","name"])->where(["in","ID",$ports_ids])->orderBy("name")->all(), "ID", "name");
        if($selected) {
            $dopQuery=Port::find()->where(["IN","ID",$selected])->select("ID");
//            print $countrysQuery->createCommand()->rawSql;
            $select_ids = ArrayHelper::toArray($dopQuery->All(), [
                'ID',
            ]);
            $ar1 = ArrayHelper::map(Port::find()->select(["ID","name"])->where(["in","ID",$select_ids])->orderBy("name")->all(), "ID", "name");
            $ar2 = ($ar1+$ar2);
        }
        return $ar2;
//        return ArrayHelper::map(Port::findAll($ports_ids), "ID", "name");
    }
    public function deprt_ports($params)
    {
        $selected = @$params["dep_ports"];
        unset($params["dep_ports"]);
        $portsQuery = $this->silver_query($params);
        if($selected) {
            $portsQuery->andWhere(["not in", "cruise.port_id", $selected]);
        }
		$portsQuery->joinWith("port pcheck");
		$portsQuery->andWhere("pcheck.check = 1");
        $portsQuery->select("cruise.port_id ID")->distinct();
        $ports_ids = ArrayHelper::toArray($portsQuery->All(), [
            'ID',
        ]);

        $ar2 = ArrayHelper::map(Port::find()->select(["ID","name"])->where(["in","ID",$ports_ids])->orderBy("name")->all(), "ID", "name");
        if($selected) {
            $dopQuery=Port::find()->where(["IN","ID",$selected])->select("ID");
//            print $countrysQuery->createCommand()->rawSql;
            $select_ids = ArrayHelper::toArray($dopQuery->All(), [
                'ID',
            ]);
            $ar1 = ArrayHelper::map(Port::find()->select(["ID","name"])->where(["in","ID",$select_ids])->orderBy("name")->all(), "ID", "name");
            $ar2 = ($ar1+$ar2);
        }
        return $ar2;
//        return ArrayHelper::map(Port::findAll($ports_ids), "ID", "name");
    }
    public function companyTypes($params)
    {
        unset($params["types"]);
        $typesQuery = $this->silver_query($params);
        $typesQuery->joinWith("company");
        $typesQuery->select("company.company_type_id ID")->distinct();
//		print $typesQuery->createCommand()->rawSql;
        $type_ids = ArrayHelper::toArray($typesQuery->All(), [
            'ID',
        ]);
        return ArrayHelper::map(CompanyType::findAll($type_ids),"ID","name");
    }
    public function ships($params)
    {
        $selected = @$params["ships"];
        unset($params["ships"]);
        $shipQuery = $this->silver_query($params);
        if($selected) {
            $shipQuery->andWhere(["not in", "cruise.ship_id", $selected]);
        }
        $shipQuery->select("cruise.ship_id ID")->distinct();
        $ship_ids = ArrayHelper::toArray($shipQuery->All(), [
            'ID',
        ]);
        $ar2 = ArrayHelper::map(Ship::find()->select(["ID","name"])->where(["in","ID",$ship_ids])->orderBy("name")->all(), "ID", "name");
        if($selected) {
            $dopQuery=Ship::find()->where(["IN","ID",$selected])->select("ID");
//            print $countrysQuery->createCommand()->rawSql;
            $select_ids = ArrayHelper::toArray($dopQuery->All(), [
                'ID',
            ]);
            $ar1 = ArrayHelper::map(Ship::find()->select(["ID","name"])->where(["in","ID",$select_ids])->orderBy("name")->all(), "ID", "name");
            $ar2 = ($ar1+$ar2);
        }
        return $ar2;
//        return ArrayHelper::map(Ship::findAll($ship_ids), "ID", "name");
    }
    public function dates($params)
    {
        unset($params["date_from"]);
        unset($params["date_to"]);
        $date1Query = $this->silver_query($params);
        $date2Query = $this->silver_query($params);
        $date1Query->select("MIN(`departure_date`) departure_date");
        $date2Query->select("MAX(`departure_date`) departure_date");
        $date1Query->union($date2Query);
        $arDates = ArrayHelper::toArray($date1Query->All(), [
            'departure_date',
        ]);
        return [
            "date_from" => @$arDates[0]["departure_date"],
            "date_to" => @$arDates[1]["departure_date"],
        ];
    }
    public function lengs($params)
    {
        unset($params["leng_from"]);
        unset($params["leng_to"]);
        $leng1Query = $this->silver_query($params);
        $leng2Query = $this->silver_query($params);
        $leng1Query->select("MIN(`cruise_length`) cruise_length");
        $leng2Query->select("MAX(`cruise_length`) cruise_length");
        $leng1Query->union($leng2Query);
//        print $leng1Query->createCommand()->rawSql;
        $arLenghts = ArrayHelper::toArray($leng1Query->All(), [
            'cruise_length',
        ]);
        return [
            "leng_from" => (@$arLenghts[0]["cruise_length"] + 1),
            "leng_to" => (@$arLenghts[1]["cruise_length"] + 1),
        ];
    }
    public function prices($params)
    {
        unset($params["price_from"]);
        unset($params["price_to"]);
        $price1Query = $this->silver_query($params);
        $price2Query = $this->silver_query($params);
        $price1Query->select("MIN(`price_rub`) price_rub");
        $price2Query->select("MAX(`price_rub`) price_rub");
        $price1Query->union($price2Query);
//        print $date1Query->createCommand()->rawSql; die;
        $arPrices = ArrayHelper::toArray($price1Query->All(), [
            'price_rub',
        ]);
//        print "<pre>";
//        print_r($arPrices);
//        die;
        return [
            "price_from" => round(@$arPrices[0]["price_rub"]),
            "price_to" => round(@$arPrices[1]["price_rub"]),
        ];
    }
    public function specials($params) {
		unset($params["specials"]);
		$specQuery = $this->silver_query($params);
		$specQuery->joinWith("actions");
		return $specQuery->select("special.ID")->count();
//		print $specQuery->createCommand()->rawSql; die;
//		return @$specQuery->all()[0]->title;
	}
}
