<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cruise_region".
 *
 * @property int $ID
 * @property int $cruise_id
 * @property int $region_id
 *
 * @property Cruise $cruise
 * @property Region $region
 */
class CruiseRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cruise_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cruise_id', 'region_id'], 'integer'],
            [['cruise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cruise::className(), 'targetAttribute' => ['cruise_id' => 'ID']],
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
            'cruise_id' => 'Cruise ID',
            'region_id' => 'Region ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruise()
    {
        return $this->hasOne(Cruise::className(), ['ID' => 'cruise_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['ID' => 'region_id']);
    }
}
