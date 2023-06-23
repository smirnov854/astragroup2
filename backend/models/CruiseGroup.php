<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "cruise_group".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $description Описание
 * @property int $image_id Иконка
 *
 * @property Cruise[] $cruises
 * @property Image $image
 */
class CruiseGroup extends models\CruiseGroup
{

}
