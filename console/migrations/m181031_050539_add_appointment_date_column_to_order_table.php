<?php

use yii\db\Migration;

/**
 * Handles adding appointment_date to table `order`.
 */
class m181031_050539_add_appointment_date_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'appointment_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order', 'appointment_date');
    }
}
