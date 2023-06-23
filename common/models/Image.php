<?php

namespace common\models;

use Yii;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\imagine\Image as iImage;
use Imagine\Image\Box;
use Imagine\Image\Point;


/**
 * This is the model class for table "image".
 *
 * @property int $ID
 * @property string $name Имя файла
 * @property int $height Высота
 * @property int $width Ширина
 * @property int $file_size Размер файла
 * @property string $content_type
 * @property string $subdir Каталог
 * @property string $original_name Оригинальное имя
 * @property string $description Описание
 * @property int $gallery_id Галерея
 *
 * @property Cabin[] $cabins
 * @property Company[] $companies
 * @property Group[] $groups
 * @property Gallery $gallery
 * @property Ship[] $ships
 * @property Special[] $specials
 * @property Users[] $users
 */
class Image extends \yii\db\ActiveRecord
{
    public $image;
    public $imageFile;
    public $imageName;
    public $crop_infos;
    public $crop_info;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }
    function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        if($this->src) {
            @unlink(Yii::getAlias('@frontend/web').$this->src);
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['name', 'subdir'], 'required'],
            [['height', 'width', 'file_size', 'gallery_id'], 'integer'],
            [['name', 'content_type', 'subdir', 'original_name', 'description'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, svg'],
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
            'name' => 'Имя файла',
            'image' => 'Изображение',
            'height' => 'Высота',
            'width' => 'Ширина',
            'file_size' => 'Размер файла',
            'content_type' => 'Content Type',
            'subdir' => 'Каталог',
            'original_name' => 'Оригинальное имя',
            'description' => 'Описание',
            'gallery_id' => 'Галерея',
        ];
    }
    public function upload($dir) {
        $cropInfo = \yii\helpers\Json::decode($this->crop_info)[0];
        $directory = Yii::getAlias('@frontend/web') . $dir . DIRECTORY_SEPARATOR ;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }
        if(!$this->image) {
            $needCrop = false;
            $arPath = explode("\\", $this->imageName);
            $imageName = end($arPath);
            $imagePath = $directory . $imageName;
            list($type, $data) = explode(';', $cropInfo['image']);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            if(!file_put_contents($imagePath, $data)) {
                return false;
            }
        }
        elseif($this->image && $this->validate()) {
            $needCrop = true;
            $imageName = $this->image->baseName . '.' . $this->image->extension;
            $imagePath = $directory . $imageName;
            if(!$this->image->saveAs($imagePath)) {
                return false;
            }
        }
        if($imagePath) {
            $this->name=$imageName;
            $this->subdir=$dir;
            $iImage = iImage::getImagine()->open($imagePath);
            if($cropInfo) {
                $size = round($cropInfo['width']) . "-" . round($cropInfo['height']) . "_" . round($cropInfo['x']) . "-" . round($cropInfo['y']);
                $newImageName = $size . "-" . $imageName;
                $this->name = $this->image = $newImageName;
                $newImagePath = $directory . $newImageName;
                if ($this->image && $needCrop) {
                    $cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
                    $cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
                    $cropInfo['x'] = $cropInfo['x']; //begin position of frame crop by X
                    $cropInfo['y'] = $cropInfo['y']; //begin position of frame crop by Y
                    try {
                        $newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
                        $cropSizeThumb = new Box($cropInfo['width'], $cropInfo['height']); //frame size of crop
                        $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
                        $iImage->resize($newSizeThumb)
                            ->crop($cropPointThumb, $cropSizeThumb)
                            ->save($newImagePath, ['quality' => 95]);

                    } catch (\Exception $e) {
                        Yii::$app->session->setFlash("warning", $e->getMessage());
                    }
                }
                else {
                    $iImage->save($newImagePath, ['quality' => 95]);
                }
            }
            return $this->save();
        }
    }
    /**
     * @param string $dir
     * @return bool
     */
    public function upload_old($dir,$cropInfo=false){
        $directory = Yii::getAlias('@frontend/web') . $dir . DIRECTORY_SEPARATOR ;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }
        if($this->image && $this->validate()){
            if(!$cropInfo) {
                $cropInfo = [
                    'x'=>0,'y'=>0,
                    'width' => 1024,
                    'height' => 780
                ];
            }
            $size = round($cropInfo['width']) . "-" . round($cropInfo['height'])."_".round($cropInfo['x']) . "-" . round($cropInfo['y']);
            $imageName = $this->image->baseName.'.'.$this->image->extension;
            $newImageName = $imageName. "-" . $size;
            $imagePath = $directory.$newImageName;
            $this->image->saveAs($imagePath);
            $this->image=$this->name=$newImageName;
            $this->subdir=$dir;
            if($cropInfo && $cropInfo['width'] && $cropInfo['height']) {
//                iImage::resize($imagePath, $cropInfo['width'],null)
//                    ->save($imagePath, ['quality' => 95]);

                try {
                    iImage::crop(
                        $imagePath,
                        intval($cropInfo['width']),
                        intval($cropInfo['height']),
                        [$cropInfo['x'], $cropInfo['y']]
                    )->resize(
                        new Box($cropInfo['width'], $cropInfo['height'])
                    )->save($imagePath, ['quality' => 80]);
                } catch (\Exception $e) {
                    Yii::$app->session->setFlash("warning", $e->getMessage());
                }
            }
            try {
                $r = $this->save();
                return $r;
            }
            catch (\Exception $e) {
                Yii::$app->session->setFlash("warning", $e->getMessage());
            }
        }else{
            return false;
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabins()
    {
        return $this->hasMany(Cabin::className(), ['image_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['image_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['image_id' => 'ID']);
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
    public function getShips()
    {
        return $this->hasMany(Ship::className(), ['image_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecials()
    {
        return $this->hasMany(Special::className(), ['image_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['image_id' => 'ID']);
    }

    public function getSrc () {
        if($this->subdir && $this->name) {
            return $this->subdir ."/". $this->name;
        }
        return null;
    }
}
