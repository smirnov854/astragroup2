<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ofice".
 *
 * @property int $ID
 * @property string $name Название офиса
 * @property string $time График работы офиса
 * @property string $addr Адрес офиса
 * @property string $map Карта
 */
class Ofice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ofice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'addr', 'map'], 'required'],
            [['time', 'addr'], 'string'],
            [['name', 'map'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'Название офиса',
            'time' => 'График работы офиса',
            'addr' => 'Адрес офиса',
            'map' => 'Карта',
        ];
    }
}
