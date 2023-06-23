<?php

namespace common\models;

use dosamigos\taggable\Taggable;
use Yii;

/**
 * This is the model class for table "cruise".
 *
 * @property int $ID
 * @property string $name Название
 * @property int $region_id Регион
 * @property int $company_id Круизная компания
 * @property int $ship_id Лайнер
 * @property int $port_id Порт отправления
 * @property string $departure_date Дата отправления
 * @property int $cruise_length Продолжительность
 * @property double $min_price Цена от
 * @property double $price_rub Цена от руб
 * @property string $useful_info Полезная информация
 * @property int $meta_id Мета
 * @property string $spec_date Дата окончания акции
 * @property int $special_id Спец. предложения
 * @property string $vender ссылка на источник
 * @property int $visible видимость
 * @property string $updated обновлено
 *
 * @property Ship $ship
 * @property Meta $meta
 * @property Region $region
 * @property Port $port
 * @property Company $company
 * @property Special $special
 * @property CruiseGroup[] $cruiseGroups
 * @property CruisePort[] $cruisePorts
 * @property CruiseRegion[] $cruiseRegions
 * @property CruiseTag[] $cruiseTags
 * @property OperatorCruise[] $operatorCruises
 * @property Order[] $orders
 * @property Price[] $prices
 * @property Review[] $reviews
 * @property SpecialCruise[] $specialCruises
 */
class Cruise extends \yii\db\ActiveRecord
{
    public $title;
    public $actions;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => Taggable::className(),
            ],
        ];
    }
    public function getAncor()
    {
        $ancor = '<a href="/cruise/' . $this->ID . '/">';
        if ($this->saledate) {
            $ancor .= $this->saledate;
        }
        //        if($this->cruise_length) {
        //            if ($ancor) $ancor .= ", ";
        //            $ancor .= $this->cruise_length . " ночей";
        //        }
        // if ($this->ship && $this->ship->htmlLink) {
        if ($this->ship && $this->ship->name) {
            if ($ancor) $ancor .= ", ";
            $ancor .= " " . $this->ship->name;
        }
        if ($this->company && $this->company->company_type_id != 2 && $this->company->name) {
            if ($ancor) $ancor .= ", ";
            $ancor .= $this->company->name;
        }
        return $ancor . '</a>';
    }
    public static function tableName()
    {
        return 'cruise';
    }
    public function formName()
    {
        return '';
    }
    public function getFullItinerary()
    {
        if (is_array($this->ports) && count($this->ports) && $this->cruisePorts) {
            $arPorts = $this->cruisePorts;
            foreach ($arPorts as $cruisePort) {
                if ($cruisePort->port->name) {
                    $arItinerary[] = $cruisePort->port->name;
                }
            }
            $itinerary = implode(" — ", $arItinerary);
            return $itinerary;
        }
        return null;
    }
    public function getOldItinerary()
    {
        if (is_array($this->ports) && count($this->ports) && $this->cruisePorts) {
            //            print '<pre>';
            //            print_r($this->cruisePorts);
            //            die;
            //            $arItinerary = $arPorts = [];
            //            foreach ($this->ports as $port) {
            //                $arPorts[@$port->ID] = $port->name;
            //            }
            //            print "<pre>";
            //            print $this->ID;
            //            print_r($this->cruisePorts);
            //            print_r($arPorts); die;
            $strlen = 0;
            $arPorts = $this->cruisePorts;
            $lastPort = end($arPorts);
            foreach ($arPorts as $cruisePort) {


                if ($cruisePort->port->name) {
                    $strlen += strlen($cruisePort->port->name) / 2 + 3;
                    if ($strlen > 210) {
                        $arItinerary[] = "...";
                        $arItinerary[] = $lastPort->port->name;
                        break;
                    }
                    $arItinerary[] = $cruisePort->port->name;
                }
            }
            $itinerary = implode(" — ", $arItinerary);
            return $itinerary;
        }
        return null;
    }
    public function getItinerary()
    {
        if (is_array($this->ports) && count($this->ports) && $this->cruisePorts) {
            //            print '<pre>';
            //            print_r($this->cruisePorts);
            //            die;
            //            $arItinerary = $arPorts = [];
            //            foreach ($this->ports as $port) {
            //                $arPorts[@$port->ID] = $port->name;
            //            }
            //            print "<pre>";
            //            print $this->ID;
            //            print_r($this->cruisePorts);
            //            print_r($arPorts); die;
            $arPorts = $this->cruisePorts;
            $lastPort = end($arPorts);
            $strlen = mb_strlen($lastPort->port->name);


            foreach ($arPorts as $cruisePort) {

                if ($cruisePort->port->name) {
                    $strlen += mb_strlen($cruisePort->port->name) + 3;
                    if ($strlen > 330) {
                        $arItinerary[] = "...";
                        $arItinerary[] = $lastPort->port->name;
                        break;
                    }
                    $arItinerary[] =  $cruisePort->port->name;
                }
            }
            $itinerary = implode(" — ", $arItinerary);
            return $itinerary;
        }
        return null;
    }
    public function getSaledate()
    {
        if ($this->departure_date && $this->cruise_length) {
            $endDate = strtotime($this->departure_date) + 24 * 60 * 60 * $this->cruise_length;
            return date("d.m.Y", strtotime($this->departure_date)) . " - " . date("d.m.Y", $endDate) . " (" . ($this->cruise_length + 1) . " дн.)";
        }
        return null;
    }
    public function getRegionName()
    {
        if ($this->region) return $this->region->name;
        return null;
    }
    public function getCompanyName()
    {
        if ($this->company) return $this->company->name;
        return null;
    }
    public function getPortName()
    {
        if ($this->port) return $this->port->name;
        return null;
    }
    public function getShipName()
    {
        if ($this->ship) return $this->ship->name;
        return null;
    }
    public function getGroup_id()
    {
        if ($this->ship) return $this->ship->name;
        return null;
    }
    public function getCurrency()
    {
        if ($this->company && $this->company->currency) {
            return Currency::find()->where(["code" => $this->company->currency])->one();
            // return $obCurrency->value;
        }
        return null;
    }
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag'])->viaTable('cruise_tag', ['cruise_id' => 'ID']);
    }
    public function getTegText()
    {
        if ($this->tags) {
            if (is_array($this->tags)) {
                $arString = [];
                foreach ($this->tags as $tag) {
                    $arString[] =  $tag->name;
                }
                return implode(", ", $arString);
            }
            return $this->tags->name;
        }
        return null;
    }
    //    public function getPriceRub() {
    //        if($this->min_price && $this->currency) {
    //            return round($this->currency->value*$this->min_price,2);
    //        }
    //        return null;
    //    }
    public function getPrintPrice()
    {
        if ($this->min_price && $this->currency) {
            return $this->min_price . $this->currency->symbol;
        }
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->min_price && $this->company && $this->company->currency) {
                // $arCurrency = Yii::$app->CbRF->filter(['currency' => (string)$this->company->currency])->one();
                $rate = Yii::$app->options->{"cbrf_" . (string) $this->company->currency};
                if ($rate) {
                    $this->price_rub = round($this->min_price * $rate, 2);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'departure_date', 'cruise_length', 'min_price'], 'required'],
            [['region_id', 'company_id', 'ship_id', 'port_id', 'cruise_length', 'meta_id', 'special_id', 'visible'], 'integer'],
            [['departure_date', 'spec_date', 'updated', 'tagNames'], 'safe'],
            [['min_price', 'price_rub'], 'number'],
            [['useful_info'], 'string'],
            [['name', 'vender'], 'string', 'max' => 255],
            [['ship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ship::className(), 'targetAttribute' => ['ship_id' => 'ID']],
            [['meta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meta::className(), 'targetAttribute' => ['meta_id' => 'ID']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'ID']],
            [['port_id'], 'exist', 'skipOnError' => true, 'targetClass' => Port::className(), 'targetAttribute' => ['port_id' => 'ID']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'ID']],
            [['special_id'], 'exist', 'skipOnError' => true, 'targetClass' => Special::className(), 'targetAttribute' => ['special_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'Название',
            'region_id' => 'Регион',
            'regionName' => 'Регион',
            'itinerary' => 'маршрут',
            'saledate' => 'даты круиза',
            'company_id' => 'Круизная компания',
            'cntry_id' => 'Страна посещения',
            'typeId' => 'Тип круиза',
            'companyName' => 'Круизная компания',
            'ship_id' => 'Лайнер',
            'shipName' => 'Лайнер',
            'port_id' => 'Порт отправления',
            'portName' => 'Порт отправления',
            'departure_date' => 'Дата',
            'cruise_length' => 'Ночей',
            'min_price' => 'Цена от',
            'useful_info' => 'Полезная информация',
            'meta_id' => 'Мета',
            'spec_date' => 'Дата окончания акции',
            'special_id' => 'Спец. предложение',
            'special.name' => 'Спец. предложение',
            'vender' => 'ссылка на источник',
            'visible' => 'видимость',
            'updated' => 'обновлено',
            'price_rub' => 'Цена от руб',
            'special_id' => 'Спец. предложения',
            'check' => 'проверено',
            'tagNames' => 'Теги'
        ];
    }
    public function getPorts()
    {
        return $this->hasMany(Port::className(), ['ID' => 'port_id'])->viaTable('cruise_port', ['cruise_id' => 'ID']);
    }
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['ID' => 'country_id'])->viaTable('port', ['ID' => 'port_id']);
    }
    public function getCheck()
    {
        foreach ($this->ports as $port) {
            if (!$port->check) return 0;
        }
        return 1;
    }
    public function getCompanyType()
    {
        return $this->hasOne(CompanyType::className(), ['ID' => 'company_type_id'])->viaTable('company', ['ID' => 'company_id']);
    }
    public function getTypeId()
    {
        if ($this->companyType) return $this->companyType->ID;
        return null;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShip()
    {
        return $this->hasOne(Ship::className(), ['ID' => 'ship_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeta()
    {
        return $this->hasOne(Meta::className(), ['ID' => 'meta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        if (!$this->region_id && $this->regions) {
            return $this->regions[0];
        }
        return $this->hasOne(Region::className(), ['ID' => 'region_id']);
    }

    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['ID' => 'region_id'])->viaTable('cruise_region', ['cruise_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPort()
    {
        return $this->hasOne(Port::className(), ['ID' => 'port_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['ID' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecial()
    {
        return $this->hasOne(Special::className(), ['ID' => 'special_id'])->viaTable('special_cruise', ['cruise_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(Special::className(), ['ID' => 'special_id'])->viaTable('special_cruise', ['cruise_id' => 'ID']);
    }


    public function getSale_text()
    {
        if ($this->special) {
            return $this->special->sale_text;
        }
        return null;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruiseGroups()
    {
        return $this->hasMany(CruiseGroup::className(), ['cruise_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruisePorts()
    {
        //        print '<pre>';
        //        print_r($this);
        //        die;
        return $this->hasMany(CruisePort::className(), ['cruise_id' => 'ID'])->orderBy(['day' => SORT_ASC]);;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruiseRegions()
    {
        return $this->hasMany(CruiseRegion::className(), ['cruise_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruiseTags()
    {
        return $this->hasMany(CruiseTag::className(), ['cruise_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorCruises()
    {
        return $this->hasMany(OperatorCruise::className(), ['cruise_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['cruise_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['cruise_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['cruise_id' => 'ID']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialCruises()
    {
        return $this->hasMany(SpecialCruise::className(), ['cruise_id' => 'ID']);
    }

    /**
     * Abstruct method for gettin visa
     * @return null
     */
    public function getVisa()
    {
        return null;
    }
    public function oldCruises($companyID)
    {
        $oldDate = date("Y-m-d H:i:s", time() - 12 * 3600);
        print $oldDate;
        return Cruise::find()->where(["<", "updated", $oldDate])->andWhere(["company_id" => $companyID])->count();
    }
    public function hide_old($companyID)
    {
        $oldDate = date("Y-m-d H:i:s", time() - 12 * 3600);
        return Cruise::updateAll(
            ["visible" => 0],
            [
                'AND',
                ["<", "updated", $oldDate],
                ["company_id" => $companyID]
            ]
        );
    }
    public function getIcons()
    {
        if ($this->company) return $this->company->cruiseIcons;
        return null;
    }
    public function afterFind()
    {
        $this->min_price = round(@$this->min_price, 0);
        $this->price_rub = round(@$this->price_rub, 0);
    }
}
