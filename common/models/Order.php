<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $ID
 * @property string $bookid Номер в системе
 * @property int $status_id Статус
 * @property int $user_id Покупатель
 * @property int $manager_id Ответсвенный
 * @property int $cruise_id Круиз
 * @property int $cabin_id Каюта
 * @property string $cabin Номер каюты
 * @property string $comment Комментарий
 * @property string $create Дата заказа
 * @property string $email Адрес почты
 * @property string $phone Телефон
 * @property string $fio ФИО
 * @property string $address Регион
 *
 * @property Users $user
 * @property Manager $manager
 * @property Cruise $cruise
 * @property Cabin $cabin0
 * @property Status $status
 */

class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_id', 'user_id', 'manager_id', 'cruise_id', 'cabin_id'], 'integer'],
            [['comment'], 'string'],
            [['create'], 'safe'],
            [['bookid', 'cabin', 'email', 'phone', 'fio', 'address'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'ID']],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manager::className(), 'targetAttribute' => ['manager_id' => 'ID']],
            [['cruise_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cruise::className(), 'targetAttribute' => ['cruise_id' => 'ID']],
            [['cabin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cabin::className(), 'targetAttribute' => ['cabin_id' => 'ID']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'bookid' => 'Bookid',
            'status_id' => 'Статус',
            'user_id' => 'User ID',
            'manager_id' => 'Manager ID',
            'cruise_id' => 'Круиз ID',
            //'cabin_id' => 'Cabin ID',
            'cabin' => 'Каюта',
            'commet' => 'Взрослые/дети',
            'comment' => 'Комментарий',
            'address' => 'Регион',
            'create' => 'Дата заказа',
            'email' => 'Email',
            'phone' => 'Телефон',
            'fio' => 'Фио'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['ID' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['ID' => 'manager_id']);
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
    public function getCabin0()
    {
        return $this->hasOne(Cabin::className(), ['ID' => 'cabin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['ID' => 'status_id']);
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->create = date("Y-m-d H:i:s");
                $this->status_id = 1;
            } elseif ($this->status_id == 1) {
                $this->status_id = 2;
            }
            return true;
        }
        return false;
    }
}

