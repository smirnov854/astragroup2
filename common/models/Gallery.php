<?php

namespace common\models;
ini_set('max_execution_time', 0);
use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\imagine\Image as iImage;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * This is the model class for table "gallery".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $description Описание
 *
 * @property Cabin[] $cabins
 * @property Company[] $companies
 * @property Image[] $images
 * @property Review[] $reviews
 * @property Ship[] $ships
 */
class Gallery extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            // [['imageList'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 20],
            [['name'], 'string', 'max' => 255],
        ];
    }
    // public $imageList;
    public $crops;
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabins()
    {
        return $this->hasMany(Cabin::className(), ['gallery_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['gallery_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['gallery_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['gallery_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShips()
    {
        return $this->hasMany(Ship::className(), ['gallery_id' => 'ID']);
    }
    public function upload($dir) {
//        var_dump($this->imageList);
//        var_dump($this->crops);
//        die;
        if ($this->validate() && $this->crops && $this->imageList && count($this->imageList) == count($this->crops)) {
//            if($this->ID) {
//                Image::deleteAll(["gallery_id"=>$this->ID]);
//            }
            foreach ($this->imageList as $key=>$imageFile) {
                $cropInfo = \yii\helpers\Json::decode($this->crops[$key])[0];
                $directory = Yii::getAlias('@frontend/web') . $dir . DIRECTORY_SEPARATOR ;
                if (!is_dir($directory)) {
                    FileHelper::createDirectory($directory);
                }
                if($imageFile && $this->validate()){
                    $imageName = $imageFile->baseName.'.'.$imageFile->extension;
                    $imagePath = $directory.$imageName;
                    $imageFile->saveAs($imagePath);
                    $newImage = new Image();
                    $newImage->image=$newImage->name=$imageName;
                    $newImage->subdir=$dir;
                    if($cropInfo) {
                        $size = round($cropInfo['width']) . "-" . round($cropInfo['height'])."_".round($cropInfo['x']) . "-" . round($cropInfo['y']);
                        $newImageName = $size . "-" . $imageName;
                        $newImage->name=$newImageName;
                        $newImagePath = $directory.$newImageName;

                        $cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
                        $cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
                        $cropInfo['x'] = $cropInfo['x']; //begin position of frame crop by X
                        $cropInfo['y'] = $cropInfo['y']; //begin position of frame crop by Y
                        try {
                            $iImage = iImage::getImagine()->open($imagePath);
                            $newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
                            $cropSizeThumb = new Box($cropInfo['width'], $cropInfo['height']); //frame size of crop
                            $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
                            $pathThumbImage = $imagePath;
                            $iImage->resize($newSizeThumb)
                                ->crop($cropPointThumb, $cropSizeThumb)
                                ->save($newImagePath, ['quality' => 95]);
                        } catch (\Exception $e) {
                            Yii::$app->session->setFlash("warning", $e->getMessage());
                        }
                    }
                    if( $newImage->save() ) {
                        $newImage->link('gallery', $this);
                    }
                }
                else {
                    Yii::$app->session->setFlash("warning", "no file or no validate!");
                }
            }
            return true;
        } elseif($this->imageList && $this->crops) {
            Yii::$app->session->setFlash("warning", "images ".count(@$this->imageList) . " cropInfos ". count(@$this->crops));
        }
        else {
            if(!$this->imageList){
                Yii::$app->session->setFlash("warning", "images  empty!");
            }
            else {
                Yii::$app->session->setFlash("warning", "crops  empty!");
            }

        }
        return false;
            foreach($model->gallery->imageList as $key => $obImage){
            $newImage = new Image();
            if($newImage->upload($dir,$crops[$key])) {
                $model->gallery->link('images',$newImage);
            }
        }
    }
}
