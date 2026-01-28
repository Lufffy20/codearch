<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%courses}}`.
 */
class m260127_093004_create_courses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%courses}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'provider' => $this->string(255),
            'year' => $this->string(10),
            'certificate_url' => $this->string(255),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-courses-cv_id',
            '{{%courses}}',
            'cv_id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%courses}}');
    }
}
