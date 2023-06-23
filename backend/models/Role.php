<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "role".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $code код
 *
 * @property Manager[] $managers
 */
class Role extends models\Role
{

}
