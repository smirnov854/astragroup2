<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "gallery".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $description Описание
 *
 * @property Cabin[] $cabins
 * @property Company[] $companies
 * @property Image[] $images
 * @property Ship[] $ships
 */
class Gallery extends models\Gallery
{

}
