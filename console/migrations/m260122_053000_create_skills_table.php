<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%skills}}`.
 */
class m260122_053000_create_skills_table extends Migration
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

        $this->createTable('{{%skills}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // FK
        $this->addForeignKey(
            'fk_skills_cv',
            '{{%skills}}',
            'cv_id',
            '{{%cv}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // optional default data
        $this->batchInsert(
            '{{%skills}}',
            ['cv_id', 'name', 'sort_order', 'created_at', 'updated_at'],
            [
                [1, 'PHP', 1, time(), time()],
                [1, 'Yii2', 2, time(), time()],
                [1, 'MySQL', 3, time(), time()],
            ]
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_skills_cv', '{{%skills}}');
        $this->dropTable('{{%skills}}');
    }
}
