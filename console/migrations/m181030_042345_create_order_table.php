<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m181030_042345_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'order_admin'=>$this->integer(),
            'order_type'=>$this->integer(),
            'order_no' =>$this->string(),
            'customer_name'=>$this->string(),
            'customer_type'=>$this->integer(),
            'contact_name' =>$this->string(),
            'contact_info' =>$this->string(),
            'payment_type' =>$this->integer(),
            'delivery_type' =>$this->integer(),
            'delivery_name' =>$this->string(),
            'order_status' =>$this->integer(),
            'created_at'=>$this->integer(),
            'created_by'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'updated_by'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order');
    }
}
