<?php

use yii\db\Migration;

/**
 * Class m220304_075140_add_adults_advice_to_system_doc_table
 */
class m220304_075140_add_adults_advice_to_system_doc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('system_docs', 'adults_advice', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('system_docs', 'adults_advice');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220304_075140_add_adults_advice_to_system_doc_table cannot be reverted.\n";

        return false;
    }
    */
}
