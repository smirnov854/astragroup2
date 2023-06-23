<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ship_type".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $description Описание
 *
 * @property Ship[] $ships
 */
class ShipType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ship_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShips()
    {
        return $this->hasMany(Ship::className(), ['type_id' => 'ID']);
    }
}
