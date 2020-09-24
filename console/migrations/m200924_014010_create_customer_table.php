<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m200924_014010_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'ci' => $this->string(11),
            'date' => $this->dateTime(),
            'product_id' => $this->integer(),
            'store_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-product_id-customer',
            'customer',
            'product_id',
            'product',
            'id'
        );

        $this->addForeignKey(
            'fk-store_id-customer',
            'customer',
            'store_id',
            'store',
            'id'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-store_id-customer', 'customer');
        $this->dropForeignKey('fk-product_id-customer', 'customer');
        $this->dropTable('{{%customer}}');
    }
}
