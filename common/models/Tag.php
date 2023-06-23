<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $ID
 * @property int $frequency
 * @property string $name
 * @property string $code
 *
 * @property CruiseTag[] $cruiseTags
 * @property OperatorTag[] $operatorTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['frequency'], 'integer'],
            [['name'], 'required'],
            [['name', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'frequency' => 'Frequency',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }
    public function findAllByName($name)
    {
        return Tag::find()->where('name LIKE :query')
            ->addParams([':query'=>"%$name%"])
            ->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruiseTags()
    {
        return $this->hasMany(CruiseTag::className(), ['tag' => 'ID']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortTags()
    {
        return $this->hasMany(Port::className(), ["port_id"=>"ID"])->viaTable("port_tag",["ID"=>"tag_id"]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorTags()
    {
        return $this->hasMany(OperatorTag::className(), ['tag_id' => 'ID']);
    }
}
