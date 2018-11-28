<?php

use yii\db\Migration;

/**
 * Class m181127_130013_create_params_tbl
 */
class m181127_130013_create_params_tbl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%config_params}}', [
            'id' => $this->primaryKey(),
            'param_name' => "VARCHAR(30) NOT NULL COMMENT 'название параметра'",
            'param_type' => "ENUM ('INT', 'FLOAT', 'TEXT') NOT NULL DEFAULT 'TEXT' COMMENT 'тип параметра'",
            'param_value' => "VARCHAR(200) NULL COMMENT 'значение параметра'",
            'author' => $this->integer()->null()->defaultValue('0')->comment('id юзера который создал запись'),
            'updated_by' => $this->integer()->null()->defaultValue('0')->comment('id юзера который обновил запись'),
            'created_at' => $this->dateTime()->null()->comment('создана запись'),
            'updated_at' => $this->dateTime()->null()->comment('обновлена запись'),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%config_params}}');

        echo "Table [ {{%config_params}} ] is dropped.\n";

        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181127_130013_create_params_tbl cannot be reverted.\n";

        return false;
    }
    */
}
