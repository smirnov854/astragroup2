<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cruise_group".
 *
 * @property int $ID
 * @property int $cruise_id
 * @property int $group_id
 *
 * @property Cruise $cruise
 * @property Group $group
 */
class CruiseGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cruise_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cruise_id', 'group_id'], 'required'],
            [['cruise_id', 'group_id'], 'integer'],
            [['cruise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cruise::className(), 'targetAttribute' => ['cruise_id' => 'ID']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'ID']],
        ];
    }
    public function getName() {
        if($this->group) {
            return $this->group->name;
        }
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'cruise_id' => 'Cruise ID',
            'group_id' => 'Group ID',
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
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['ID' => 'group_id']);
    }
}
