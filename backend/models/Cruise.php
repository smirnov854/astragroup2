<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "cruise".
 *
 * @property int $ID
 * @property string $name Название
 * @property int $region_id Регион
 * @property int $company_id Круизная компания
 * @property int $ship_id Лайнер
 * @property int $port_id Порт отправления
 * @property int $group_id Группы
 * @property string $departure_date Дата отправления
 * @property int $cruise_length Продолжительность
 * @property double $min_price Цена от
 * @property string $useful_info Полезная информация
 * @property int $meta_id Мета
 * @property string $spec_date Дата окончания акции
 * @property int $special_id Спец. предложения
 * @property string $vender ссылка на источник
 *
 * @property Ship $ship
 * @property Meta $meta
 * @property Region $region
 * @property Port $port
 * @property Company $company
 * @property CruiseGroup $group
 * @property Special $special
 * @property CruisePort[] $cruisePorts
 * @property CruiseRegion[] $cruiseRegions
 * @property Order[] $orders
 * @property Price[] $prices
 */
class Cruise extends models\Cruise
{

}
