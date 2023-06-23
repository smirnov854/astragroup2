<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cabin_group".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $info описание
 * @property int $image_id Изображение
 * @property int $gallery_id Галерея
 * @property int $cabin_loc_id Тип каюты
 * @property int $ship_id Лайнер
 *
 * @property Cabin[] $cabins
 * @property Image $image
 * @property Gallery $gallery
 * @property CabinLoc $cabinLoc
 * @property Ship $ship
 */
class CabinGroup extends \yii\db\ActiveRecord
{
    public $crop_info;
    public $crop_infos;
    public $imageIds;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabin_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['imageIds'], 'safe'],
            [['info'], 'string'],
            [['image_id', 'gallery_id', 'cabin_loc_id', 'ship_id', 'sort' ], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'ID']],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'ID']],
            [['cabin_loc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CabinLoc::className(), 'targetAttribute' => ['cabin_loc_id' => 'ID']],
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
            'info' => 'описание',
            'image_id' => 'Изображение',
            'gallery_id' => 'Галерея',
            'cabin_loc_id' => 'Тип каюты',
            'ship_id' => 'Лайнер',
            'sort' => 'Индекс сортировки'
        ];
    }
    public function getImageList() {
        $gallery = null;
        if($this->gallery && $this->gallery->images) $gallery = $this->gallery->images;
        if($this->image) {
            if(is_array($gallery) && count($gallery)) {
                array_unshift($gallery, $this->image);
            }
            else{
                $gallery = [$this->image];
            }
        }
        return $gallery;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabins()
    {
        return $this->hasMany(Cabin::className(), ['cabin_grp_id' => 'ID'])->orderBy('sort');
    }
    public function getImages () {
        if($this->gallery && $this->gallery->images) return $this->gallery->images;
        return null;
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
    public function getShip()
    {
        return $this->hasOne(Ship::className(), ['ID' => 'ship_id']);
    }
    public function getOrder () {
        if(!$this->sort) {
            if($this->cabinLoc && $this->cabinLoc->sort) {
                return $this->cabinLoc->sort;
            }
            return null;
        }
    }
}
