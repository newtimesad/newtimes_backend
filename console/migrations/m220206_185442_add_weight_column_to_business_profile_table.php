<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%business_profile}}`.
 */
class m220206_185442_add_weight_column_to_business_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('business_profile', 'weight', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('business_profile', 'weight');
    }
}
