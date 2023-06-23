<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "ship_type".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $description Описание
 *
 * @property Ship[] $ships
 */
class ShipType extends models\ShipType
{

}
