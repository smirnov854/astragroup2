<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "price".
 *
 * @property int $ID
 * @property int $cruise_id Круиз
 * @property int $cabin_id Каюта
 * @property double $value Цена
 * @property string $currency Валюта
 *
 * @property Cruise $cruise
 * @property Cabin $cabin
 */
class Price extends models\Price
{

}
