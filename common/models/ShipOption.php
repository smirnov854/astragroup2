<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ship_option".
 *
 * @property int $ship_id
 * @property string $title
 * @property string $value
 *
 * @property Ship $ship
 */
class ShipOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ship_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ship_id'], 'integer'],
            [['title'], 'required'],
            [['title', 'value'], 'string', 'max' => 255],
            [['ship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ship::className(), 'targetAttribute' => ['ship_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ship_id' => 'Ship ID',
            'title' => 'Title',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShip()
    {
        return $this->hasOne(Ship::className(), ['ID' => 'ship_id']);
    }
}
