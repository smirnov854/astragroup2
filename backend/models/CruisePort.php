<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "cruise_port".
 *
 * @property int $ID
 * @property int $port_id Порт захода
 * @property int $cruise_id Круиз
 * @property string $arrival Прибытие
 * @property string $departure Отправление
 * @property string $info Описание
 * @property string $date Дата захода
 * @property int $day День захода
 *
 * @property Cruise $cruise
 * @property Port $port
 */
class CruisePort extends models\CruisePort
{

}
