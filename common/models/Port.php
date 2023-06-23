<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "port".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $name_en Название (Eng)
 * @property int $region_id Регион
 * @property int $country_id Страна
 * @property string $info Описание
 * @property string $excursion Экскурсии
 * @property string $places Достопримечательности
 * @property double $lat широта
 * @property double $lon долгота
 * @property int $check Проверено
 * @property int $meta_id Мета
 *
 * @property Cruise[] $cruises
 * @property CruisePort[] $cruisePorts
 * @property Region $region
 * @property Meta $meta
 * @property Country $country
 * @property PortKies[] $portKies
 * @property PortRegion[] $portRegions
 */
class Port extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'port';
    }
    /* Геттер для названия региона */
    public function getRegionName() {
        if($this->region) return $this->region->name;
        return null;
    }
    public function getCountryName() {
        if($this->country) return $this->country->name;
        return null;
    }
    public function getCoords() {
        if(!$this->lat || !$this->lon) return null;
        return $this->lat . ', ' . $this->lon;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_en'], 'required'],
            [['region_id', 'country_id', 'check', 'meta_id'], 'integer'],
            [['regionName','countryName','coords','lat','lon','tagNames'],'safe'],
            [['info', 'excursion', 'places'], 'string'],
            [['lat', 'lon'], 'number'],
            [['name', 'name_en'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'ID']],
            [['meta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meta::className(), 'targetAttribute' => ['meta_id' => 'ID']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'ID']],
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
            'name_en' => 'Название (Eng)',
            'region_id' => 'Регион',
            'regionName' => 'Регион',
            'country_id' => 'Страна',
            'countryName' => 'Страна',
            'info' => 'Описание',
            'excursion' => 'Экскурсии',
            'places' => 'Достопримечательности',
            'lat' => 'широта',
            'lon' => 'долгота',
            'coords' => 'Координаты',
            'check' => 'Проверено',
            'meta_id' => 'Мета',
            'tagNames' => 'Теги'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruises()
    {
        return $this->hasMany(Cruise::className(), ['port_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruisePorts()
    {
        return $this->hasMany(CruisePort::className(), ['port_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortKies()
    {
        return $this->hasMany(PortKies::className(), ['port_id' => 'ID']);
    }

    public function changePortId($newID) {
        if (!is_numeric($newID)) return false;
        $newPort = Port::findOne($newID);
        if(!$newPort){
            throwException("New Port not found!");
            return false;
        }
        if( ( !$newPort->lat || !$newPort->lon) && $this->lat && $this->lon) {
            $newPort->lat = $this->lat;
            $newPort->lon = $this->lon;
            $newPort->save();
        }
        Cruise::updateAll(["port_id"=>$newID], ["port_id"=>$this->ID]);
        // PortRegion::updateAll(["port_id"=>$newID], ["port_id"=>$this->ID]);
        PortKies::updateAll(["port_id"=>$newID], ["port_id"=>$this->ID]);
        CruisePort::updateAll(["port_id"=>$newID], ["port_id"=>$this->ID]);
        OperatorPort::updateAll(["port_id"=>$newID],["port_id"=>$this->ID]);
        return $this->delete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortRegions()
    {
        return $this->hasMany(PortRegion::className(), ['port_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['ID' => 'region_id']);
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
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['ID' => 'country_id']);
    }
    public function getGallery() {
        return null;
    }
    public function getTags() {
        return $this->hasMany(Tag::className(), ["ID"=>"port_id"])->viaTable("port_tag",["tag_id"=>"ID"]);
    }
    public function getTagsText () {
        if($this->tags) {
            $return = [];
            foreach($this->tags as $tag) {
                if($tag->name) $return[] = $tag->name;
            }
            return implode(", ",$return);
        }
    }
}

