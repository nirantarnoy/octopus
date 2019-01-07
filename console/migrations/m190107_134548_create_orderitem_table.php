<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orderitem`.
 */
class m190107_134548_create_orderitem_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orderitem', [
            'id' => $this->primaryKey(),
            'title'=> $this->string(),
            'qty' => $this->integer(),
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
        $this->dropTable('orderitem');
    }
}
