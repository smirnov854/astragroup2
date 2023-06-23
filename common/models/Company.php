<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "company".
 *
 * @property int $ID
 * @property string $name Название
 * @property int $company_group_id Группа
 * @property int $company_type_id Тип круиза
 * @property string $preview Анонс
 * @property string $detail Описание
 * @property string $description Общая характеристика
 * @property string $flot_info Флот компании
 * @property string $food_info Питание и напитки
 * @property string $activity_info Развлечения на борту
 * @property string $dress_info Дресс-код
 * @property string $kids_info Отдых с детьми
 * @property string $celebration_info Особые события и праздники
 * @property string $rus_info Русский язык
 * @property string $loyalty_info Программа лояльности
 * @property string $villa_info Привилегии для пассажиров кают Heaven и Villa
 * @property string $age_limit Возрастные ограничения
 * @property string $booking_info Условия бронирования и аннуляции
 * @property int $image_id Изображение
 * @property int $gallery_id Галерея
 * @property string $penalty_info Штрафные санкции
 * @property string $ship_info На лайнере
 * @property int $meta_id Мета
 * @property string $currency Валюта
 *
 * @property CompanyGroup $companyGroup
 * @property Image $image
 * @property Gallery $gallery
 * @property Meta $meta
 * @property CompanyType $companyType
 * @property Cruise[] $cruises
 * @property OperatorCompany[] $operatorCompanies
 * @property Ship[] $ships
 */
class Company extends \yii\db\ActiveRecord
{
	public $crop_info;

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'company';
	}

	public function getCompanyGroupName()
	{
		if ($this->companyGroup) {
			return $this->companyGroup->name;
		}
		return null;
	}

	public function getLogo()
	{
		if ($this->image && $this->image->src && $this->company_type_id != 2) {
			return $this->image->src;
		}
		return null;
	}

	public function getHtmlLink()
	{
		if ($this->ID && $this->name) {
			return Html::a($this->name, '/company/' . $this->ID.'/');
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['name', 'penalty_info', 'ship_info'], 'required'],
			[['company_group_id', 'company_type_id', 'image_id', 'gallery_id', 'meta_id'], 'integer'],
			[['detail', 'description', 'flot_info', 'food_info', 'activity_info', 'dress_info', 'kids_info', 'celebration_info', 'rus_info', 'loyalty_info', 'villa_info', 'age_limit', 'booking_info', 'penalty_info', 'ship_info'], 'string'],
			[['name', 'preview'], 'string', 'max' => 255],
			[['currency'], 'string', 'max' => 3],
			[
				['company_group_id'],
				'exist',
				'skipOnError' => true,
				'targetClass' => CompanyGroup::className(),
				'targetAttribute' => ['company_group_id' => 'ID']
			],
			[
				['image_id'],
				'exist',
				'skipOnError' => true,
				'targetClass' => Image::className(),
				'targetAttribute' => ['image_id' => 'ID']
			],
			[
				['gallery_id'],
				'exist',
				'skipOnError' => true,
				'targetClass' => Gallery::className(),
				'targetAttribute' => ['gallery_id' => 'ID']
			],
			[
				['meta_id'],
				'exist',
				'skipOnError' => true,
				'targetClass' => Meta::className(),
				'targetAttribute' => ['meta_id' => 'ID']
			],
			[
				['company_type_id'],
				'exist',
				'skipOnError' => true,
				'targetClass' => CompanyType::className(),
				'targetAttribute' => ['company_type_id' => 'ID']
			],
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
			'company_group_id' => 'Группа',
			'companyGroupName' => 'Группа',
			'company_type_id' => 'Тип круиза',
			'companyTypeName' => 'Тип круиза',
			'preview' => 'Анонс',
			'detail' => 'Описание',
			'description' => 'Общая характеристика',
			'flot_info' => 'Флот компании',
			'food_info' => 'Питание и напитки',
			'activity_info' => 'Развлечения на борту',
			'dress_info' => 'Дресс-код',
			'kids_info' => 'Отдых с детьми',
			'celebration_info' => 'Особые события и праздники',
			'rus_info' => 'Русский язык',
			'loyalty_info' => 'Программа лояльности',
			'villa_info' => 'Привилегии для пассажиров отдельных категорий кают',
			'age_limit' => 'Возрастные и прочие ограничения',
			'booking_info' => 'Условия бронирования и аннуляции',
			'image_id' => 'Изображение',
			'gallery_id' => 'Галерея',
			'penalty_info' => 'Штрафные санкции',
			'ship_info' => 'На лайнере',
			'meta_id' => 'Мета',
			'currency' => 'Валюта',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCompanyGroup()
	{
		return $this->hasOne(CompanyGroup::className(), ['ID' => 'company_group_id']);
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

	public function getShipGallery()
	{
		if($this->ships && count($this->ships)) {
			$gallery = [];
			foreach ($this->ships as $ship) {
				if($ship->image && $ship->image->src) {
					$gallery[] = $ship->image;
				}
			}
			if(count($gallery)) return $gallery;
		}
		return null;
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
	public function getCompanyType()
	{
		return $this->hasOne(CompanyType::className(), ['ID' => 'company_type_id']);
	}

	public function getCompanyTypeName()
	{
		if ($this->companyType) {
			return $this->companyType->name;
		}
		return null;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCruises()
	{
		return $this->hasMany(Cruise::className(), ['company_id' => 'ID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOperatorCompanies()
	{
		return $this->hasMany(OperatorCompany::className(), ['company_id' => 'ID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getShips()
	{
		return $this->hasMany(Ship::className(), ['company_id' => 'ID']);
	}

	public function getCategories()
	{
		if ($this->ships) {
			$arCategories = [];
			foreach ($this->ships as $obShip) {
				if ($obShip->cabins) {
					foreach ($obShip->cabins as $cabin) {
						$arCategories[] = $cabin;
					}
				}
			}
		}
		if (count($arCategories)) {
			return $arCategories;
		}
		return null;
	}

	public function getGroupCompanies()
	{
		return $this->hasMany(GroupCompany::className(), ['company_id' => 'ID'])->with('groupCategories');
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCruiseIcons()
	{
		return $this->hasMany(CruiseIcons::className(), ['ID' => 'cruise_icon_id'])->viaTable('company_icons', ["company_id"=>"ID"]);
	}

}