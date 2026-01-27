<?php

use yii\db\Migration;

/**
 * Adds template_id column to cv table
 */
class m260123_100001_add_template_id_to_cv_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%cv}}', 'template_id', $this->integer()->defaultValue(1));
        
        $this->addForeignKey(
            'fk-cv-template_id',
            '{{%cv}}',
            'template_id',
            '{{%cv_templates}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-cv-template_id', '{{%cv}}');
        $this->dropColumn('{{%cv}}', 'template_id');
    }
}