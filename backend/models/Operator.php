<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "operator".
 *
 * @property int $ID
 * @property string $name Название
 * @property int $procent Процент надбавки
 *
 * @property OperatorCompany[] $operatorCompanies
 */
class Operator extends models\Operator
{

}
