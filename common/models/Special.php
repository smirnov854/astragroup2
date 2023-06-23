<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "special".
 *
 * @property int $ID
 * @property int $name Название
 * @property string $info Описание
 * @property int $image_id Значок
 * @property int $procent Скидка
 * @property int $sale_text Подпись
 * @property string $from начало акции
 * @property string $to окончание акции
 *
 * @property Cruise[] $cruises
 * @property Image $image
 * @property SpecialCruise[] $specialCruises
 */
class Special extends \yii\db\ActiveRecord
{

    public $crop_info;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'special';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['image_id', 'procent'], 'integer'],
            [['name','sale_text'], 'string', 'max' => 255],
            [['info'], 'string'],
            [['from', 'to', 'cruisesList'], 'safe'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'ID']],
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
            'image_id' => 'Значок',
            'procent' => 'Скидка',
            'sale_text' => 'Подпись',
            'from' => 'начало акции',
            'to' => 'окончание акции',
            'cruisesList' => 'Список круизов'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruises()
    {
        return $this->hasMany(Cruise::className(), ['ID' => 'cruise_id'])->viaTable('special_cruise', ['special_id' => 'ID']);
    }
    public function getCruisesList () {
        if ($this->cruises) {
            $arReturn = [];
            foreach ($this->cruises as $cruise) {
                $arReturn[]=$cruise->ID;
            }
            return implode(",",$arReturn);
        }
        return "";
    }
    public function setCruisesList($val) {
        $this->cruisesList=$val;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['ID' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialCruises()
    {
        return $this->hasMany(SpecialCruise::className(), ['special_id' => 'ID']);
    }
    public  function getDates () {
        if($this->from && $this->to) {
            return date("d.m.Y",strtotime($this->from))  . " - " . date("d.m.Y",strtotime($this->to));
        }
        return null;
    }
}
