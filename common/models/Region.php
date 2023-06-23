<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $info Описание
 * @property string $code Символьный код
 * @property int $region_id Родитель
 * @property int $meta_id Мета
 *
 * @property CountryRegion[] $countryRegions
 * @property Cruise[] $cruises
 * @property CruiseRegion[] $cruiseRegions
 * @property Port[] $ports
 * @property PortRegion[] $portRegions
 * @property Meta $meta
 * @property Region $region
 * @property Region[] $regions
 * @property Review[] $reviews
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['info'], 'string'],
            [['region_id', 'meta_id'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
            [['meta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meta::className(), 'targetAttribute' => ['meta_id' => 'ID']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'ID']],
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
            'info' => 'Описание',
            'code' => 'Символьный код',
            'region_id' => 'Родитель',
            'region.name' => 'Родитель',
            'meta_id' => 'Мета',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryRegions()
    {
        return $this->hasMany(CountryRegion::className(), ['region_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruises()
    {
        return $this->hasMany(Cruise::className(), ['region_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruiseRegions()
    {
        return $this->hasMany(CruiseRegion::className(), ['region_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPorts()
    {
        return $this->hasMany(Port::className(), ['region_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortRegions()
    {
        return $this->hasMany(PortRegion::className(), ['region_id' => 'ID']);
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
        return $this->hasOne(Region::className(), ['ID' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['region_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['region_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClimat() {
        return$this->hasMany(RegionClimat::className(),['region_id' => 'ID']);
    }
}
