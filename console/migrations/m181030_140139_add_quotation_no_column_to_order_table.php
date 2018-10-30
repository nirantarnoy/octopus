<?php

use yii\db\Migration;

/**
 * Handles adding quotation_no to table `order`.
 */
class m181030_140139_add_quotation_no_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'quotation_no', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order', 'quotation_no');
    }
}
