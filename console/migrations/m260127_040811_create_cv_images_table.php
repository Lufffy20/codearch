<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cv_images}}`.
 */
class m260127_040811_create_cv_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cv_images}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'type' => $this->string(50)->notNull(), // profile, cover, signature
            'image_path' => $this->string(255)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Index
        $this->createIndex(
            'idx-cv_images-cv_id',
            '{{%cv_images}}',
            'cv_id'
        );

        // Foreign Key
        $this->addForeignKey(
            'fk-cv_images-cv_id',
            '{{%cv_images}}',
            'cv_id',
            '{{%cv}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-cv_images-cv_id', '{{%cv_images}}');
        $this->dropIndex('idx-cv_images-cv_id', '{{%cv_images}}');
        $this->dropTable('{{%cv_images}}');
    }
}
