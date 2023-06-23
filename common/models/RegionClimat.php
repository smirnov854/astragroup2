<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region_climat".
 *
 * @property int $region_id Регион
 * @property string $date Дата
 * @property int $temp Температура
 * @property string $icon Значок
 *
 * @property Region $region
 */
class RegionClimat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region_climat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'date', 'temp', 'icon'], 'required'],
            [['region_id', 'temp'], 'integer'],
            [['date'], 'safe'],
            [['icon'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Регион',
            'date' => 'Дата',
            'temp' => 'Температура',
            'icon' => 'Значок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['ID' => 'region_id']);
    }
}
