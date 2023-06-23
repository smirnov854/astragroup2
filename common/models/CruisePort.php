<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cruise_port".
 *
 * @property int $ID
 * @property int $port_id Порт захода
 * @property int $cruise_id Круиз
 * @property string $arrival Прибытие
 * @property string $departure Отправление
 * @property string $info Описание
 * @property string $date Дата захода
 * @property int $day День захода
 *
 * @property Cruise $cruise
 * @property Port $port
 */
class CruisePort extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cruise_port';
    }
    public function getPortName () {
        if($this->port) {
            if($this->port->country_id) {
                $obCountry = Country::findOne($this->port->country_id);
                if($obCountry->name) {
                    $this->port->name .= ", " . $obCountry->name;
                }
            }
            return $this->port->name;
        }
        return null;
    }
    public function getArrival() {
        if(is_null($this->arrival)) return "-";
        return $this->arrival;
    }
    public function setArrival($value) {
        if($value == "-") $this->arrival = NULL;
        else $this->arrival = $value;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['port_id', 'cruise_id', 'day'], 'integer'],
            [['date', 'day'], 'required'],
            [['arrival', 'departure', 'date'], 'safe'],
            [['info'], 'string'],
            [['cruise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cruise::className(), 'targetAttribute' => ['cruise_id' => 'ID']],
            [['port_id'], 'exist', 'skipOnError' => true, 'targetClass' => Port::className(), 'targetAttribute' => ['port_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'port_id' => 'Порт захода',
            'portName' => 'Порт захода',
            'cruise_id' => 'Круиз',
            'arrival' => 'Прибытие',
            'departure' => 'Отправление',
            'info' => 'Описание',
            'date' => 'Дата захода',
            'day' => 'День захода',
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
    public function getPort()
    {
        return $this->hasOne(Port::className(), ['ID' => 'port_id']);
    }
	public function afterFind() {
		$time = strtotime($this->date);
		$this->date = date("d.m.y",$time); // после выгрузки из базы делаем название большими буквами
	}

	public function getCountry() {
        if($this->port && $this->port->country_id) {
            return Country::findOne($this->port->country_id);
        }
    }
}
