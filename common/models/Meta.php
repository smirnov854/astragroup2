<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meta".
 *
 * @property int $ID
 * @property string $title Тайтл
 * @property string $description meta описание
 * @property string $keywords ключевые слова
 *
 * @property Articles[] $articles
 * @property Company[] $companies
 * @property Country[] $countries
 * @property Cruise[] $cruises
 * @property Port[] $ports
 * @property Region[] $regions
 * @property Ship[] $ships
 */
class Meta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'keywords'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'title' => 'Тайтл',
            'description' => 'meta описание',
            'keywords' => 'ключевые слова',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['meta_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['meta_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['meta_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruises()
    {
        return $this->hasMany(Cruise::className(), ['meta_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPorts()
    {
        return $this->hasMany(Port::className(), ['meta_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['meta_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShips()
    {
        return $this->hasMany(Ship::className(), ['meta_id' => 'ID']);
    }
}
