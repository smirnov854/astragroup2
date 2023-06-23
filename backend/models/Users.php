<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "users".
 *
 * @property int $ID
 * @property string $f_name Имя
 * @property string $l_name Фамилия
 * @property string $2_name Отчество
 * @property int $login Логин
 * @property int $password Пароль
 * @property int $email Email
 * @property int $phone Телефон
 * @property int $image_id Портрет
 *
 * @property Manager[] $managers
 * @property Order[] $orders
 * @property Image $image
 */
class Users extends models\Users
{

}
