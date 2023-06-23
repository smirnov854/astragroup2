<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "company".
 *
 * @property int $ID
 * @property string $name Название
 * @property int $company_group_id Группа
 * @property string $preview Анонс
 * @property string $detail Описание
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
 * @property Cruise[] $cruises
 * @property OperatorCompany[] $operatorCompanies
 * @property Ship[] $ships
 */
class Company extends models\Company
{

}
