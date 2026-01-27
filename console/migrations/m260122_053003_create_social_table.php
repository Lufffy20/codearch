<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%social}}`.
 */
class m260122_053003_create_social_table extends Migration
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

        $this->createTable('{{%social}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'platform' => $this->string(255)->notNull(),
            'url' => $this->string(255)->notNull(),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // FK
        $this->addForeignKey(
            'fk_social_cv',
            '{{%social}}',
            'cv_id',
            '{{%cv}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // optional default data
        $this->batchInsert(
            '{{%social}}',
            ['cv_id', 'platform', 'url', 'sort_order', 'created_at', 'updated_at'],
            [
                [1, 'GitHub', 'https://github.com/username', 1, time(), time()],
                [1, 'LinkedIn', 'https://linkedin.com/in/username', 2, time(), time()],
            ]
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_social_cv', '{{%social}}');
        $this->dropTable('{{%social}}');
    }
}
