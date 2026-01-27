<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%education}}`.
 */
class m260122_053002_create_education_table extends Migration
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

        $this->createTable('{{%education}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'degree' => $this->string(255)->notNull(),
            'institute' => $this->string(255)->notNull(),
            'year' => $this->string(255),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // FK
        $this->addForeignKey(
            'fk_education_cv',
            '{{%education}}',
            'cv_id',
            '{{%cv}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // optional default data
        $this->insert('{{%education}}', [
            'cv_id' => 1,
            'degree' => 'BCA',
            'institute' => 'XYZ University',
            'year' => '2021 – 2024',
            'sort_order' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_education_cv', '{{%education}}');
        $this->dropTable('{{%education}}');
    }
}
