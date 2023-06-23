<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "operator_country".
 *
 * @property int $ID
 * @property int $operator_id
 * @property int $country_id
 * @property string $reference
 *
 * @property Operator $operator
 * @property Country $country
 */
class OperatorCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operator_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'country_id', 'reference'], 'required'],
            [['operator_id', 'country_id'], 'integer'],
            [['reference'], 'string', 'max' => 255],
            [['operator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Operator::className(), 'targetAttribute' => ['operator_id' => 'ID']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'ID']],
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
            'country_id' => 'Country ID',
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
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['ID' => 'country_id']);
    }
}
