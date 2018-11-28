<?php

use yii\db\Migration;

/**
 * Class m181128_204213_add_unique_constrain_for_column
 */
class m181128_204213_add_unique_constrain_for_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('unique_constrain_1','{{%config_params}}','param_name',1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('unique_constrain_1','{{%config_params}}');

        echo "Index 'unique_constrain_1' for table '{{%config_params}}' is dropped.\n";
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181128_204213_add_unique_constrain_for_column cannot be reverted.\n";

        return false;
    }
    */
}
