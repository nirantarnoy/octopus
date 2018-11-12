<?php

use yii\db\Migration;

/**
 * Class m181112_074838_add_column_to_order_table
 */
class m181112_074838_add_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order','email',$this->string());
        $this->addColumn('order','phone',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order','email');
        $this->dropColumn('order','phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_074838_add_column_to_order_table cannot be reverted.\n";

        return false;
    }
    */
}
