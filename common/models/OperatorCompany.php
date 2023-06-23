<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "operator_company".
 *
 * @property int $ID
 * @property int $operator_id
 * @property int $company_id
 * @property string $reference
 *
 * @property Operator $operator
 * @property Company $company
 */
class OperatorCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operator_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'company_id'], 'integer'],
            [['reference'], 'string', 'max' => 255],
            [['operator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Operator::className(), 'targetAttribute' => ['operator_id' => 'ID']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'ID']],
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
            'company_id' => 'Company ID',
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
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['ID' => 'company_id']);
    }
}
