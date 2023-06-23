<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "order".
 *
 * @property int $ID
 * @property string $bookid Номер в системе
 * @property int $status_id Статус
 * @property int $user_id Покупатель
 * @property int $manager_id Ответсвенный
 * @property int $cruise_id Круиз
 * @property int $cabin_id Каюта
 * @property string $cabin Номер каюты
 *
 * @property Status $status
 * @property Users $user
 * @property Manager $manager
 * @property Cruise $cruise
 * @property Cabin $cabin0
 */
class Order extends models\Order
{

}
