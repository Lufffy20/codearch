<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cv_templates}}`.
 */
class m260123_100000_create_cv_templates_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%cv_templates}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'template_file' => $this->string(255)->notNull(),
            'category' => $this->string(50)->defaultValue('professional'),
            'thumbnail_url' => $this->string(255),
            'is_active' => $this->boolean()->defaultValue(true),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Insert default templates
        $time = time();
        $this->batchInsert('{{%cv_templates}}', [
            'name', 'description', 'template_file', 'category', 'thumbnail_url', 'is_active', 'sort_order', 'created_at', 'updated_at'
        ], [
            [
                'Classic Professional',
                'A clean and professional CV template',
                'classic.php',
                'professional',
                '/images/templates/classic.jpg',
                true,
                1,
                $time,
                $time
            ],
            [
                'Modern Creative',
                'A modern and creative CV template',
                'modern.php',
                'creative',
                '/images/templates/modern.jpg',
                true,
                2,
                $time,
                $time
            ],
            [
                'Minimal Design',
                'A minimal and elegant CV template',
                'minimal.php',
                'minimal',
                '/images/templates/minimal.jpg',
                true,
                3,
                $time,
                $time
            ],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cv_templates}}');
    }
}