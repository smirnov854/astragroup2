<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "operator_port".
 *
 * @property int $ID
 * @property int $operator_id
 * @property int $port_id
 * @property string $reference
 *
 * @property Operator $operator
 * @property Port $port
 */
class OperatorPort extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operator_port';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'port_id', 'reference'], 'required'],
            [['operator_id', 'port_id'], 'integer'],
            [['reference'], 'string', 'max' => 255],
            [['operator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Operator::className(), 'targetAttribute' => ['operator_id' => 'ID']],
            [['port_id'], 'exist', 'skipOnError' => true, 'targetClass' => Port::className(), 'targetAttribute' => ['port_id' => 'ID']],
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
            'port_id' => 'Port ID',
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
    public function getPort()
    {
        return $this->hasOne(Port::className(), ['ID' => 'port_id']);
    }
}
