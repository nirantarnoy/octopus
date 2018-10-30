<?php

use yii\db\Migration;

/**
 * Class m181030_114603_add_group_id_column_to_user_tabel
 */
class m181030_114603_add_group_id_column_to_user_tabel extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('user','group_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    $this->dropColumn('user','group_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_114603_add_group_id_column_to_user_tabel cannot be reverted.\n";

        return false;
    }
    */
}
