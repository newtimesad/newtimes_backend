<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%system_docs}}`.
 */
class m220227_085843_create_system_docs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%system_docs}}', [
            'id' => $this->primaryKey(),
            'privacy' => $this->text(),
            'terms_conditions' => $this->text(),
            'advertiser_agreement' => $this->text(),
            'about' => $this->text(),
            'exemption' => $this->text(),
            'dmca_photo_complaints' => $this->text(),
            'trademarks' => $this->text(),
            'reporting_trafficking' => $this->text(),
            'law_enforcement' => $this->text(),
            'verified' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%system_docs}}');
    }
}
