<?php

namespace backend\models;

use Yii, common\models;

/**
 * This is the model class for table "meta".
 *
 * @property int $ID
 * @property string $title Тайтл
 * @property string $description meta описание
 * @property string $keywords ключевые слова
 *
 * @property Articles[] $articles
 * @property Company[] $companies
 * @property Country[] $countries
 * @property Cruise[] $cruises
 * @property Port[] $ports
 * @property Region[] $regions
 * @property Ship[] $ships
 */
class Meta extends models\Meta
{

}
