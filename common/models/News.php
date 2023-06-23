<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $ID
 * @property string $title Заголовок
 * @property string $preview Анонс
 * @property string $detail Описание
 * @property int $image_id изображение
 * @property int $special_id Акция
 * @property int $meta_id
 *
 * @property Image $image
 * @property Special $special
 * @property Meta $meta
 */
class News extends \yii\db\ActiveRecord
{

	public $crop_info;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'detail'], 'required'],
            [['preview', 'detail'], 'string'],
            [['image_id', 'special_id', 'meta_id'], 'integer'],
			['crop_info', 'safe'],
            [['title'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'ID']],
            [['special_id'], 'exist', 'skipOnError' => true, 'targetClass' => Special::className(), 'targetAttribute' => ['special_id' => 'ID']],
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
            'title' => 'Заголовок',
            'preview' => 'Анонс',
            'detail' => 'Описание',
            'image_id' => 'изображение',
            'special_id' => 'Акция',
            'special.name' => 'Акция',
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
    public function getSpecial()
    {
        return $this->hasOne(Special::className(), ['ID' => 'special_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeta()
    {
        return $this->hasOne(Meta::className(), ['ID' => 'meta_id']);
    }
    public function getDates() {
        if($this->special && $this->special->dates) {
            return $this->special->dates;
        }
        return null;
    }

//	public function afterSave($insert, $changedAttributes)
//	{
//
//		// open image
//		$image = Image::getImagine()->open($this->image->tempName);
//
//		// rendering information about crop of ONE option
//		$cropInfo = Json::decode($this->crop_info)[0];
//		$cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
//		$cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
//		$cropInfo['x'] = $cropInfo['x']; //begin position of frame crop by X
//		$cropInfo['y'] = $cropInfo['y']; //begin position of frame crop by Y
//		// Properties bolow we don't use in this example
//		//$cropInfo['ratio'] = $cropInfo['ratio'] == 0 ? 1.0 : (float)$cropInfo['ratio']; //ratio image.
//		//$cropInfo['width'] = (int)$cropInfo['width']; //width of cropped image
//		//$cropInfo['height'] = (int)$cropInfo['height']; //height of cropped image
//		//$cropInfo['sWidth'] = (int)$cropInfo['sWidth']; //width of source image
//		//$cropInfo['sHeight'] = (int)$cropInfo['sHeight']; //height of source image
//
//		//delete old images
//		$oldImages = FileHelper::findFiles(Yii::getAlias('@path/to/save/image'), [
//			'only' => [
//				$this->id . '.*',
//				'thumb_' . $this->id . '.*',
//			],
//		]);
//		for ($i = 0; $i != count($oldImages); $i++) {
//			@unlink($oldImages[$i]);
//		}
//
//		//saving thumbnail
//		$newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
//		$cropSizeThumb = new Box(200, 200); //frame size of crop
//		$cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
//		$pathThumbImage = Yii::getAlias('@path/to/save/image')
//			. '/thumb_'
//			. $this->id
//			. '.'
//			. $this->image->getExtension();
//
//		$image->resize($newSizeThumb)
//			->crop($cropPointThumb, $cropSizeThumb)
//			->save($pathThumbImage, ['quality' => 100]);
//
//		//saving original
//		$this->image->saveAs(
//			Yii::getAlias('@path/to/save/image')
//			. '/'
//			. $this->id
//			. '.'
//			. $this->image->getExtension()
//		);
//	}
}
