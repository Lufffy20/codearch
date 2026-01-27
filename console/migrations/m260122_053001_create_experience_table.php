<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%experience}}`.
 */
class m260122_053001_create_experience_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%experience}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'company' => $this->string(255)->notNull(),
            'position' => $this->string(255)->notNull(),
            'duration' => $this->string(255),
            'description' => $this->text()->notNull(),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // FK
        $this->addForeignKey(
            'fk_experience_cv',
            '{{%experience}}',
            'cv_id',
            '{{%cv}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // optional default data
        $this->insert('{{%experience}}', [
            'cv_id' => 1,
            'company' => 'ABC Tech',
            'position' => 'Backend Developer',
            'duration' => '2023 – Present',
            'description' => 'Worked on Yii2 applications, APIs, and performance optimization.',
            'sort_order' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_experience_cv', '{{%experience}}');
        $this->dropTable('{{%experience}}');
    }
}
