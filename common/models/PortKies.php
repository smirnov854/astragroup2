<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "port_kies".
 *
 * @property int $ID
 * @property int $port_id
 * @property string $keyword
 *
 * @property Port $port
 */
class PortKies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'port_kies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['port_id', 'keyword'], 'required'],
            [['port_id'], 'integer'],
            [['keyword'], 'string', 'max' => 255],
            [['port_id'], 'exist', 'skipOnError' => true, 'targetClass' => Port::className(), 'targetAttribute' => ['port_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'port_id' => 'Port ID',
            'keyword' => 'Keyword',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPort()
    {
        return $this->hasOne(Port::className(), ['ID' => 'port_id']);
    }
}
