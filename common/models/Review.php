<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $ID
 * @property string $title Заголовок
 * @property string $description Текст отзыва
 * @property int $user_id Пользователь
 * @property int $cruise_id Круиз
 * @property int $ship_id Лайнер
 * @property int $region_id Регион
 * @property int $gallery_id Галлерея
 * @property int $service обслуживание на борту
 * @property int $ship Лайнер
 * @property int $ofice Работа в офисе
 * @property int $programms Развлекательные программы
 * @property int $food Питание
 *
 * @property Users $user
 * @property Cruise $cruise
 * @property Ship $ship0
 * @property Region $region
 * @property Gallery $gallery
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }
    public function getImage () {
        if ($this->user) return $this->user->image;
    }
    public function getUserName () {
        if($this->user) return $this->user->username;
        return null;
    }
    public function getCruiseName () {
        if($this->cruise) return $this->cruise->name;
        return null;
    }
    public function getShipName () {
        if($this->liner) return $this->liner->name;
        return null;
    }
    public function getRegionName () {
        if($this->region) return $this->region->name;
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['user_id', 'cruise_id', 'ship_id', 'region_id', 'gallery_id', 'service', 'ship', 'ofice', 'programms', 'food'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['cruise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cruise::className(), 'targetAttribute' => ['cruise_id' => 'ID']],
            [['ship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ship::className(), 'targetAttribute' => ['ship_id' => 'ID']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'ID']],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Текст отзыва',
            'user_id' => 'Пользователь',
            'userName' => 'Пользователь',
            'cruiseName' => 'Круиз',
            'cruise_id' => 'Круиз ID',
            'shipName' => 'Лайнер',
            'ship_id' => 'Лайнер ID',
            'region_id' => 'Регион',
            'regionName' => 'Регион',
            'gallery_id' => 'Галлерея',
            'service' => 'на борту',
            'ship' => 'Лайнер',
            'ofice' => 'в офисе',
            'programms' => 'программы',
            'food' => 'Питание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
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
    public function getLiner()
    {
        return $this->hasOne(Ship::className(), ['ID' => 'ship_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['ID' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['ID' => 'gallery_id']);
    }
}
