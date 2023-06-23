<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "operator_cabin".
 *
 * @property int $ID
 * @property int $operator_id
 * @property int $cabin_id
 * @property string $reference
 *
 * @property Operator $operator
 * @property Cabin $cabin
 */
class OperatorCabin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operator_cabin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'cabin_id', 'reference'], 'required'],
            [['operator_id', 'cabin_id'], 'integer'],
            [['reference'], 'string', 'max' => 255],
            [['operator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Operator::className(), 'targetAttribute' => ['operator_id' => 'ID']],
            [['cabin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cabin::className(), 'targetAttribute' => ['cabin_id' => 'ID']],
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
            'cabin_id' => 'Cabin ID',
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
    public function getCabin()
    {
        return $this->hasOne(Cabin::className(), ['ID' => 'cabin_id']);
    }
}
