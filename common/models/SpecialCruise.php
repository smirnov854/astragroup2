<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "special_cruise".
 *
 * @property int $ID
 * @property int $special_id
 * @property int $cruise_id
 * @property double $min_price
 *
 * @property Special $special
 * @property Cruise $cruise
 */
class SpecialCruise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'special_cruise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['special_id', 'cruise_id'], 'required'],
            [['special_id', 'cruise_id'], 'integer'],
            [['min_price'], 'number'],
            [['special_id'], 'exist', 'skipOnError' => true, 'targetClass' => Special::className(), 'targetAttribute' => ['special_id' => 'ID']],
            [['cruise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cruise::className(), 'targetAttribute' => ['cruise_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'special_id' => 'Special ID',
            'cruise_id' => 'Cruise ID',
            'min_price' => 'Min Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecial()
    {
        return $this->hasOne(Special::className(), ['ID' => 'special_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruise()
    {
        return $this->hasOne(Cruise::className(), ['ID' => 'cruise_id']);
    }
}
