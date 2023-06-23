<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "deck".
 *
 * @property int $ID
 * @property string $name Название
 * @property int $number Номер
 * @property int $image_id Схема
 * @property int $ship_id
 * @property string $description Описание
 *
 * @property CabinDeck[] $cabinDecks
 * @property Image $image
 * @property Ship $ship
 */
class Deck extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deck';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'number', 'image_id', 'ship_id'], 'required'],
            [['number', 'image_id', 'ship_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'ID']],
            [['ship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ship::className(), 'targetAttribute' => ['ship_id' => 'ID']],
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
            'number' => 'Номер',
            'image_id' => 'Схема',
            'image' => 'Схема',
            'ship_id' => 'Ship ID',
            'shipName' => 'Лайнер',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabinDecks()
    {
        return $this->hasMany(CabinDeck::className(), ['deck_id' => 'ID']);
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
    public function getShip()
    {
        return $this->hasOne(Ship::className(), ['ID' => 'ship_id']);
    }
    public function getShipName() {
        if($this->ship) {
            return $this->ship->name;
        }
        return null;
    }
}
