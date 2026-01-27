<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%personal_details}}`.
 */
class m260122_052531_create_personal_details_table extends Migration
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

        $this->createTable('{{%personal_details}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'role' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'phone' => $this->string(255),
            'location' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // FK
        $this->addForeignKey(
            'fk_personal_details_cv',
            '{{%personal_details}}',
            'cv_id',
            '{{%cv}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Default data
        $this->insert('{{%personal_details}}', [
            'cv_id' => 1,
            'name' => 'Parmar meet',
            'role' => 'Yii2 Developer',
            'email' => 'john.doe@example.com',
            'phone' => '+91 99999 99999',
            'location' => 'India',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_personal_details_cv', '{{%personal_details}}');
        $this->dropTable('{{%personal_details}}');
    }
}
