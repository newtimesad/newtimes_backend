<?php

use yii\db\Migration;

/**
 * Class m220208_191819_add_title_to_post_table
 */
class m220208_191819_add_title_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'title');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220208_191819_add_title_to_post_table cannot be reverted.\n";

        return false;
    }
    */
}
