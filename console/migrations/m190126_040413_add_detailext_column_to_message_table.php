<?php

use yii\db\Migration;

/**
 * Handles adding detailext to table `{{%message}}`.
 */
class m190126_040413_add_detailext_column_to_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%message}}', 'detail_ext', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%message}}', 'detail_ext');
    }
}
