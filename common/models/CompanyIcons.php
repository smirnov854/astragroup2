<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_icons".
 *
 * @property int $cruise_icon_id
 * @property int $company_id
 *
 * @property CruiseIcons $cruiseIcon
 * @property Company $company
 */
class CompanyIcons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_icons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cruise_icon_id', 'company_id'], 'required'],
            [['cruise_icon_id', 'company_id'], 'integer'],
            [['cruise_icon_id'], 'exist', 'skipOnError' => true, 'targetClass' => CruiseIcons::className(), 'targetAttribute' => ['cruise_icon_id' => 'ID']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cruise_icon_id' => 'Cruise Icon ID',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruiseIcon()
    {
        return $this->hasOne(CruiseIcons::className(), ['ID' => 'cruise_icon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['ID' => 'company_id']);
    }
}
