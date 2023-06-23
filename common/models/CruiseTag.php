<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cruise_tag".
 *
 * @property int $ID
 * @property int $cruise_id
 * @property int $tag
 *
 * @property Cruise $cruise
 * @property Tag $tag0
 */
class CruiseTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cruise_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cruise_id', 'tag'], 'integer'],
            [['cruise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cruise::className(), 'targetAttribute' => ['cruise_id' => 'ID']],
            [['tag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'cruise_id' => 'Cruise ID',
            'tag' => 'Tag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruise()
    {
        return $this->hasOne(Cruise::className(), ['ID' => 'cruise_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag0()
    {
        return $this->hasOne(Tag::className(), ['ID' => 'tag']);
    }
}
