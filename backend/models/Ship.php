<?php

namespace backend\models;

use Yii, common\models;

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
 * @property Cruise $cruise
 * @property Company $company
 * @property ShipType $type
 * @property Gallery $gallery
 * @property Image $image
 * @property Meta $meta
 */
class Ship extends models\Ship
{

}
