<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "operator".
 *
 * @property int $ID
 * @property string $name Название
 * @property int $procent Процент надбавки
 *
 * @property OperatorCompany[] $operatorCompanies
 */
class Operator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'procent'], 'required'],
            [['procent'], 'integer'],
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
            'procent' => 'Процент надбавки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorCompanies()
    {
        return $this->hasMany(OperatorCompany::className(), ['operator_id' => 'ID']);
    }
    public function getOperatorCompany($ref) {
        $model = OperatorCompany::find()->where(["reference"=>$ref])->one();
        return $model;
    }
}
