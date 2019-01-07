<?php

use yii\db\Migration;

/**
 * Handles adding order_id to table `orderitem`.
 */
class m190107_141214_add_order_id_column_to_orderitem_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('orderitem','order_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('orderitem','order_id');
    }
}
