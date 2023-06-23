<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property int $ID
 * @property string $title Заголовок
 * @property string $preview Анонс
 * @property string $link ссылка
 * @property int $image_id изображение
 * @property int $page_id изображение
 *
 * @property Image $image
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'preview', 'link'], 'required'],
            [['image_id', 'page_id'], 'integer'],
            [['title', 'preview', 'link'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'ID']],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'ID']],
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
            'preview' => 'Анонс',
            'link' => 'ссылка',
            'page' => 'Страница',
            'page_id' => 'Страница',
            'image_id' => 'изображение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['ID' => 'image_id']);
    }
    public function getPage() {
        return $this->hasOne(Page::className(),['ID' => 'page_id']);
    }
}
