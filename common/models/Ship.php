<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "ship".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $code Символьный код
 * @property string $preview Анонс
 * @property string $detail Описание
 * @property string $info Информация о судне
 * @property string $cabin_info Информация о каютах
 * @property string $food_info Питание на борту
 * @property string $Entertainment_Info Развлечения
 * @property int $type_id Тип судна
 * @property int $company_id Компания
 * @property int $image_id Изображение
 * @property int $gallery_id Галерея
 * @property int $meta_id Мета
 *
 * @property Cabin[] $cabins
 * @property Cruise[] $cruises
 * @property OperatorShip[] $operatorShips
 * @property Review[] $reviews
 * @property ShipType $type
 * @property Gallery $gallery
 * @property Image $image
 * @property Meta $meta
 * @property Company $company
 */
class Ship extends \yii\db\ActiveRecord
{
    public $cnt;
    public $crop_info;
    public $crop_infos;
    public $imageIds;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ship';
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
    public function getImages () {
        if($this->gallery && $this->gallery->images) return $this->gallery->images;
        return null;
    }
    public function getLogo () {
        if($this->company && $this->company->logo) return $this->company->logo;
        return null;
    }
    public function getCompanyName () {
        if($this->company) return $this->company->name;
        return null;
    }
    public function getOptions () {
        $options=false;
        if ($this->ID) {
            $options = ShipOption::findAll(
                ["ship_id"=>$this->ID]
            );
        }
        if(!$options || !count(@$options)) {
            $options = ShipOption::find()->where(['IS', 'ship_id', null])->andWhere(['IS', 'value', null])->All();
        }
        return $options;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['imageIds'], 'safe'],
            [['preview', 'detail', 'info', 'cabin_info', 'bars_info', 'cazino_info', 'pool_info', 'cinima_info', 'map_info', 'food_info',
                'Entertainment_Info', 'stars'], 'string'],
            [['type_id', 'company_id', 'image_id', 'gallery_id', 'meta_id'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShipType::className(), 'targetAttribute' => ['type_id' => 'ID']],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'ID']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'ID']],
            [['meta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meta::className(), 'targetAttribute' => ['meta_id' => 'ID']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'ID']],
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
            'code' => 'Символьный код',
            'preview' => 'Анонс',
            'detail' => 'Описание лайнера',
            'info' => 'Особенности лайнера',
            'stars' => 'Класс лайнера',
            'cabin_info' => 'Информация о каютах',
            'bars_info' => 'Бары',
            'cazino_info' => 'Казино',
            'pool_info' => 'Бассейны',
            'cinima_info' => 'Кинотеатры',
            'map_info' => 'Сервис для детей',
            'food_info' => 'Рестораны и бары',
            'Entertainment_Info' => 'Развлечения',
            'type_id' => 'Тип судна',
            'type.name' => 'Тип судна',
            'company_id' => 'Компания',
            'companyName' => 'Компания',
            'image_id' => 'Изображение',
            'image.name' => 'Изображение',
            'gallery_id' => 'Галерея',
            'meta_id' => 'Мета',
        ];
    }
    public function getHtmlLink () {
        if($this->ID && $this->name) {
            return Html::a($this->name. " " . @$this->stars, '/ship/' . $this->ID.'/');
        }
        return null;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabins()
    {
        return $this->hasMany(Cabin::className(), ['ship_id' => 'ID']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabinGroups()
    {
        return $this->hasMany(CabinGroup::className(), ['ship_id' => 'ID'])->orderBy("sort");;
    }
    public function getLocations () {
        return $this->hasMany(CabinLoc::className(), ['ID' => 'cabin_loc_id'])->viaTable("cabin", ["ship_id"=>'ID'])->orderBy("sort");
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruises()
    {
        return $this->hasMany(Cruise::className(), ['ship_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorShips()
    {
        return $this->hasMany(OperatorShip::className(), ['ship_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['ship_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ShipType::className(), ['ID' => 'type_id']);
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
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['ID' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeta()
    {
        return $this->hasOne(Meta::className(), ['ID' => 'meta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['ID' => 'company_id']);
    }
    public function getDecks() {
        return $this->hasMany(Deck::className(), ['ship_id' => 'ID'])->orderBy(['number' => SORT_DESC]);
    }
    public  function getActions () {
        if($this->cruises) {
            $actions = [];
            foreach ($this->cruises as $cruise) {
                if($cruise->actions) {
                    $actions = $cruise->actions;
                }
            }
            return $actions;
        }
        return null;
    }
    public function getNumbers () {
        return null;
    }
	public function afterFind() {
		$name = strtoupper($this->name);
		$this->name = $name; // после выгрузки из базы делаем название большими буквами
	}
}