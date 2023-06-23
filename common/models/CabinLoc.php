<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cabin_loc".
 *
 * @property int $ID
 * @property string $name Название
 *
 * @property Cabin[] $cabins
 */
class CabinLoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabin_loc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort'], 'integer'],
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
            'sort' => 'Индекс сортировки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabins()
    {
        return $this->hasMany(Cabin::className(), ['cabin_loc_id' => 'ID']);
    }
}
