<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "image".
 *
 * @property int $ID
 * @property string $name Имя файла
 * @property int $height Высота
 * @property int $width Ширина
 * @property int $file_size Размер файла
 * @property string $content_type
 * @property string $subdir Каталог
 * @property string $original_name Оригинальное имя
 * @property string $description Описание
 * @property int $gallery_id Галерея
 *
 * @property Cabin[] $cabins
 * @property Company[] $companies
 * @property CruiseGroup[] $cruiseGroups
 * @property Gallery $gallery
 * @property Ship[] $ships
 * @property Users[] $users
 */
class Image extends models\Image
{

}
