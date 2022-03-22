<?php

use yii\db\Migration;

/**
 * Class m220322_080114_update_country_state_and_city_table
 */
class m220322_080114_update_country_state_and_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('country', 'available', $this->boolean()->defaultValue(true));
        $this->addColumn('state', 'available', $this->boolean()->defaultValue(true));
        $this->addColumn('city', 'available', $this->boolean()->defaultValue(true));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('country', 'available');
        $this->dropColumn('state', 'available');
        $this->dropColumn('city', 'available');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_080114_update_country_state_and_city_table cannot be reverted.\n";

        return false;
    }
    */
}
