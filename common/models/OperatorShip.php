<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "operator_ship".
 *
 * @property int $ID
 * @property int $operator_id
 * @property int $ship_id
 * @property string $reference
 *
 * @property Operator $operator
 * @property Ship $ship
 */
class OperatorShip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operator_ship';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'ship_id'], 'integer'],
            [['reference'], 'required'],
            [['reference'], 'string', 'max' => 255],
            [['operator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Operator::className(), 'targetAttribute' => ['operator_id' => 'ID']],
            [['ship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ship::className(), 'targetAttribute' => ['ship_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'operator_id' => 'Operator ID',
            'ship_id' => 'Ship ID',
            'reference' => 'Reference',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperator()
    {
        return $this->hasOne(Operator::className(), ['ID' => 'operator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShip()
    {
        return $this->hasOne(Ship::className(), ['ID' => 'ship_id']);
    }
}
