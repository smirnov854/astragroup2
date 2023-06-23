<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $ID
 * @property string $name Название
 * @property string $description Описание
 * @property int $image_id Иконка
 *
 * @property CruiseGroup[] $cruiseGroups
 * @property Image $image
 * @property OperatorGroup[] $operatorGroups
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['image_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'ID']],
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
            'description' => 'Описание',
            'image_id' => 'Иконка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruiseGroups()
    {
        return $this->hasMany(CruiseGroup::className(), ['group_id' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['ID' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorGroups()
    {
        return $this->hasMany(OperatorGroup::className(), ['group_id' => 'ID']);
    }
}
