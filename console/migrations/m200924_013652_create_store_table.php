<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store}}`.
 */
class m200924_013652_create_store_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'address' => $this->string(),
            'code' => $this->string(16),
            'imei' => $this->string(15)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store}}');
    }
}
