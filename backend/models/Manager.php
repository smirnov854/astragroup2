<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "manager".
 *
 * @property int $ID
 * @property int $role_id Роль
 * @property int $user_id Пользователь
 *
 * @property Role $role
 * @property Users $user
 * @property Order[] $orders
 */
class Manager extends models\Manager
{

}
