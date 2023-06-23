<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "region".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $info Описание
 * @property string $code Символьный код
 * @property int $region_id Родитель
 * @property int $meta_id Мета
 *
 * @property CountryRegion[] $countryRegions
 * @property Cruise[] $cruises
 * @property CruiseRegion[] $cruiseRegions
 * @property Port[] $ports
 * @property PortRegion[] $portRegions
 * @property Meta $meta
 * @property Region $region
 * @property Region[] $regions
 */
class Region extends models\Region
{

}
