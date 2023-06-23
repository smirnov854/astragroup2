<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "country".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $name_en Название (Eng)
 * @property string $code Символьный код
 * @property int $meta_id Мета
 * @property int $visa_id Виза
 *
 * @property Meta $meta
 * @property CountryRegion[] $countryRegions
 * @property Port[] $ports
 */
class Country extends models\Country
{

}
