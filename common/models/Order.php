<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $order_admin
 * @property int $order_type
 * @property string $order_no
 * @property string $customer_name
 * @property int $customer_type
 * @property string $contact_name
 * @property string $contact_info
 * @property int $payment_type
 * @property int $delivery_type
 * @property string $delivery_name
 * @property int $order_status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
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
            [['order_type','order_no'],'required'],
            [['quotation_no'],'string'],
            [['appointment_date'],'safe'],
            [['order_admin', 'order_type', 'customer_type', 'payment_type', 'delivery_type', 'order_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['order_no', 'customer_name', 'contact_name', 'contact_info', 'delivery_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_admin' => Yii::t('app', 'ผู้ดูแล'),
            'order_type' => Yii::t('app', 'ประเภทงาน'),
            'order_no' => Yii::t('app', 'เลขที่ใบสั่ง'),
            'quotation_no' => Yii::t('app', 'ใบเสนอราคา'),
            'customer_name' => Yii::t('app', 'ชื่อลูกค้า'),
            'customer_type' => Yii::t('app', 'ประเภทลูกค้า'),
            'contact_name' => Yii::t('app', 'Facebook/Line'),
            'contact_info' => Yii::t('app', 'ข้อมูลติดต่อ'),
            'payment_type' => Yii::t('app', 'ประเภทชำระเงิน'),
            'delivery_type' => Yii::t('app', 'ประเภทการจัดส่ง'),
            'delivery_name' => Yii::t('app', 'ที่อยู่ในการจัดส่ง'),
            'appointment_date' => Yii::t('app', 'วันที่นัดหมาย'),
            'order_status' => Yii::t('app', 'สถานะ'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'updated_at' => Yii::t('app', 'แก้ไขเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_by' => Yii::t('app', 'แก้ไขโดย'),
        ];
    }
}
