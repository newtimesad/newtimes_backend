<?php

use yii\db\Migration;

/**
 * Class m220310_215728_add_price_to_city_table
 */
class m220310_215728_add_price_to_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('city', 'price', $this->float()->defaultValue(0.0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('city', 'price');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220310_215728_add_price_to_city_table cannot be reverted.\n";

        return false;
    }
    */
}
