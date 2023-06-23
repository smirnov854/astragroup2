<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cabin".
 *
 * @property int $ID
 * @property string $name Название
 * @property int $ship_id Судно
 * @property string $code Код
 * @property int $capacity Размещение
 * @property int $image_id Изображение
 * @property int $gallery_id Галерея
 * @property int $cabin_loc_id Тип каюты
 * @property string $info описание
 *
 * @property Ship $ship
 * @property Image $image
 * @property Gallery $gallery
 * @property CabinLoc $cabinLoc
 * @property OperatorCabin[] $operatorCabins
 * @property Order[] $orders
 * @property Price[] $prices
 */
class Cabin extends \yii\db\ActiveRecord
{
    public $crop_info;
    public $crop_infos;
    public $imageIds;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabin';
    }
    public function getShipName() {
        if($this->ship) return $this->ship->name;
        return null;
    }
    public function getCabinLocName() {
        if($this->cabinLoc) return $this->cabinLoc->name;
        return null;
    }
    public function getCabinGrpName() {
        if($this->cabinGroup) return $this->cabinGroup->name;
        return null;
    }
    public function getImages () {
        if($this->gallery && $this->gallery->images) return $this->gallery->images;
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['ship_id', 'capacity', 'image_id', 'gallery_id', 'cabin_loc_id','cabin_grp_id','sort'], 'integer'],
            [['info'], 'string'],
            [['name', 'code'], 'string', 'max' => 255],
            [['ship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ship::className(), 'targetAttribute' => ['ship_id' => 'ID']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'ID']],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'ID']],
            [['cabin_loc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CabinLoc::className(), 'targetAttribute' => ['cabin_loc_id' => 'ID']],
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
            'ship_id' => 'Судно',
            'shipName' => 'Судно',
            'code' => 'Код',
            'capacity' => 'Размещение',
            'image_id' => 'Изображение',
            'image.name' => 'Изображение',
            'gallery_id' => 'Галерея',
            'cabin_loc_id' => 'Тип каюты',
            'cabin_grp_id' => 'Группа каюты',
            'cabinGrpName' => 'Группа каюты',
            'cabinLocName' => 'Тип каюты',
            'info' => 'описание',
            'sort' => 'Индекс сортирвки'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShip()
    {
        return $this->hasOne(Ship::className(), ['ID' => 'ship_id']);
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
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['ID' => 'gallery_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabinLoc()
    {
        return $this->hasOne(CabinLoc::className(), ['ID' => 'cabin_loc_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabinGroup()
    {
        return $this->hasOne(CabinGroup::className(), ['ID' => 'cabin_grp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorCabins()
    {
        return $this->hasMany(OperatorCabin::className(), ['cabin_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['cabin_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['cabin_id' => 'ID']);
    }
    public function getDecks () {
        return $this->hasMany(Deck::className(),["cabin_id" => "ID"])->viaTable("cabin_deck", ["deck_id" => "ID"]);
    }
}
