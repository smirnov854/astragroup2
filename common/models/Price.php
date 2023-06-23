<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $ID
 * @property int $cruise_id Круиз
 * @property int $cabin_id Каюта
 * @property double $value Цена
 * @property string $currency Валюта
 *
 * @property Cruise $cruise
 * @property Cabin $cabin
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    public $del;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cruise_id', 'cabin_id', 'value', 'currency'], 'required'],
            [['cruise_id', 'cabin_id'], 'integer'],
            [['value'], 'number'],
            [['currency'], 'string', 'max' => 3],
            [['cruise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cruise::className(), 'targetAttribute' => ['cruise_id' => 'ID']],
            [['cabin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cabin::className(), 'targetAttribute' => ['cabin_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'cruise_id' => 'Круиз',
            'cabin_id' => 'Каюта',
            'value' => 'Цена',
            'currency' => 'Валюта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruise()
    {
        return $this->hasOne(Cruise::className(), ['ID' => 'cruise_id']);
    }

    public function getSymbol () {
        if($this->currency) {
            $obCurrency =  Currency::find()->where(["code"=>$this->currency])->one();
            if($obCurrency && $obCurrency->symbol) return $obCurrency->symbol;
        }
        return false;
    }
    public function getRub () {
        if($this->currency && $this->value) {
            $rate = Yii::$app->options->{"cbrf_".(string)strtoupper($this->currency)};
            return round($this->value * $rate,0);
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabin()
    {
        return $this->hasOne(Cabin::className(), ['ID' => 'cabin_id']);
    }

    public function getCabinLoc () {
        return$this->hasMany(CabinLoc::className(),["ID"=>"cabin_loc_id"])->viaTable("cabin",["ID" => "cabin_id"]);
    }
}
