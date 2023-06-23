<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "command".
 *
 * @property int $ID
 * @property string $name ФИО
 * @property string $role Должность
 * @property string $contact Контактная информация
 */
class Command extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'command';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'role', 'contact'], 'required'],
            [['name', 'role', 'contact'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'ФИО',
            'role' => 'Должность',
            'contact' => 'Контактная информация',
        ];
    }
}
