<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group_company".
 *
 * @property int $ID
 * @property int $company_id Компания
 * @property string $name Название
 * @property int $cabin_loc_id Тип каюты
 * @property int $sort Индекс сортировки
 *
 * @property GroupCategory[] $groupCategories
 * @property Company $company
 * @property CabinLoc $cabinLoc
 */
class GroupCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'cabin_loc_id', 'sort'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'ID']],
            [['cabin_loc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CabinLoc::className(), 'targetAttribute' => ['cabin_loc_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'company_id' => 'Компания',
            'name' => 'Название',
            'cabin_loc_id' => 'Тип каюты',
            'sort' => 'Индекс сортировки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupCategories()
    {
        return $this->hasMany(GroupCategory::className(), ['group_company_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['ID' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabinLoc()
    {
        return $this->hasOne(CabinLoc::className(), ['ID' => 'cabin_loc_id']);
    }
}
