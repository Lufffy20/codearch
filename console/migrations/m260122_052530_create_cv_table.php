<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cv}}`.
 */
class m260122_052530_create_cv_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cv}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // default CV
        $this->insert('{{%cv}}', [
            'title' => 'Main CV',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cv}}');
    }
}
