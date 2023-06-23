<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "cabin".
 *
 * @property int $ID
 * @property string $name Название
 * @property int $ship_id Судно
 * @property string $code Код
 * @property int $capacity Размещение
 * @property int $image_id Изображение
 * @property int $gallery_id Галерея
 * @property int $cabin_loc_id Тип каюты
 *
 * @property Ship $ship
 * @property Image $image
 * @property Gallery $gallery
 * @property CabinLoc $cabinLoc
 * @property Order[] $orders
 * @property Price[] $prices
 */
class Cabin extends models\Cabin
{

}
