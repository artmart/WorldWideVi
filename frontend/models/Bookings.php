<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bookings".
 *
 * @property int $id
 * @property string|null $time
 * @property string|null $email
 * @property string|null $name
 * @property string|null $scheduleID
 * @property string|null $bookedDATE
 * @property string|null $agent
 * @property string|null $price
 * @property int|null $paid
 */
class Bookings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
            [['paid'], 'integer'],
            [['email', 'name', 'bookedDATE'], 'string', 'max' => 128],
            [['scheduleID'], 'string', 'max' => 32],
            [['agent', 'price'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'email' => 'Email',
            'name' => 'Name',
            'scheduleID' => 'Schedule ID',
            'bookedDATE' => 'Booked Date',
            'agent' => 'Agent',
            'price' => 'Price',
            'paid' => 'Paid',
        ];
    }
}
