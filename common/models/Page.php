<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property int $ID
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property int $image_id
 * @property int $gallery_id
 * @property int $meta_id
 *
 * @property Image $image
 * @property Gallery $gallery
 * @property Meta $meta
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'description'], 'required'],
            [['description'], 'string'],
            [['image_id', 'gallery_id', 'meta_id'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'ID']],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'ID']],
            [['meta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meta::className(), 'targetAttribute' => ['meta_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'description' => 'Description',
            'image_id' => 'Image ID',
            'gallery_id' => 'Gallery ID',
            'meta_id' => 'Meta ID',
        ];
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
    public function getMeta()
    {
        return $this->hasOne(Meta::className(), ['ID' => 'meta_id']);
    }
    public function getBanner() {
        return $this->hasMany(Banner::className(), ['page_id' => 'ID']);
    }
}
