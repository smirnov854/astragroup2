<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "main_icons".
 *
 * @property int $ID
 * @property string $title Звгвловок
 * @property int $image_id иконка
 * @property string $link ссылка
 *
 * @property Image $image
 */
class MainIcons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_icons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['image_id'], 'integer'],
            [['title', 'link'], 'string', 'max' => 255],
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
            'title' => 'Звгвловок',
            'image_id' => 'иконка',
            'link' => 'ссылка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['ID' => 'image_id']);
    }
}
