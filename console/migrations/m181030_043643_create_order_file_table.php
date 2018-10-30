<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_file`.
 */
class m181030_043643_create_order_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_file', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'type' => $this->integer(),
            'file_type' => $this->integer(),
            'order_id' => $this->integer(),
            'status' =>$this->integer(),
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
        $this->dropTable('order_file');
    }
}
