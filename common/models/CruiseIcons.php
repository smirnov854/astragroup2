<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cruise_icons".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $src Путь
 *
 * @property CompanyIcons[] $companyIcons
 */
class CruiseIcons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cruise_icons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'src'], 'required'],
            [['name', 'src'], 'string', 'max' => 255],
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
            'src' => 'Путь',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyIcons()
    {
        return $this->hasMany(CompanyIcons::className(), ['cruise_icon_id' => 'ID']);
    }
}
