<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "port".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $name_en Название (Eng)
 * @property int $region_id Регион
 * @property int $country_id Страна
 * @property string $info Описание
 * @property string $excursion Экскурсии
 * @property string $places Достопримечательности
 * @property int $meta_id Мета
 *
 * @property Cruise[] $cruises
 * @property CruisePort[] $cruisePorts
 * @property Region $region
 * @property Meta $meta
 * @property Country $country
 * @property PortKies[] $portKies
 * @property PortRegion[] $portRegions
 */
class Port extends models\Port
{

}
