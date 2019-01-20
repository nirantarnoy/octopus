<?php

use yii\db\Migration;

/**
 * Handles adding all_qty to table `{{%product}}`.
 */
class m190119_122600_add_all_qty_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'all_qty', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'all_qty');
    }
}
