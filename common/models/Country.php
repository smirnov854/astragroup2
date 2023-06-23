<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $name_en Название (Eng)
 * @property string $code Символьный код
 * @property int $meta_id Мета
 * @property int $visa_id Виза
 *
 * @property Meta $meta
 * @property CountryRegion[] $countryRegions
 * @property Port[] $ports
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['meta_id', 'visa_id'], 'integer'],
            [['name', 'name_en', 'code'], 'string', 'max' => 255],
            [['meta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meta::className(), 'targetAttribute' => ['meta_id' => 'ID']],
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
            'code' => 'Символьный код',
            'meta_id' => 'Мета',
            'visa_id' => 'Виза',
        ];
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
    public function getCountryRegions()
    {
        return $this->hasMany(CountryRegion::className(), ['country_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPorts()
    {
        return $this->hasMany(Port::className(), ['country_id' => 'ID']);
    }
}
