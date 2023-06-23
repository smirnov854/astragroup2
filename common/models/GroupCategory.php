<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group_category".
 *
 * @property int $ID
 * @property string $name
 * @property string $code
 * @property int $group_company_id
 * @property int $sort
 *
 * @property GroupCompany $groupCompany
 */
class GroupCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public function behaviors( ) {
        return [
            [
                'class' => 'sjaakp\sortable\Sortable',
                'orderAttribute' => "sort"
            ],
        ];
    }

    public static function tableName()
    {
        return 'group_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'sort'], 'required'],
            [['group_company_id', 'sort'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
            [['group_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupCompany::className(), 'targetAttribute' => ['group_company_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'group_company_id' => 'Group Company ID',
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupCompany()
    {
        return $this->hasOne(GroupCompany::className(), ['ID' => 'group_company_id']);
    }
    public function getCompany_id()
    {
        if($this->groupCompany) {
            return @$this->groupCompany->company_id;
        }
        return null;
    }
}
