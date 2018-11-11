<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_status`.
 */
class m181111_141154_create_order_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_status', [
            'id' => $this->primaryKey(),
            'order_id'=>$this->integer(),
            'note' => $this->string(),
            'status'=>$this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order_status');
    }
}
