<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%awards}}`.
 */
class m260127_092957_create_awards_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%awards}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'organization' => $this->string(255),
            'year' => $this->string(10),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-awards-cv_id',
            '{{%awards}}',
            'cv_id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%awards}}');
    }
}
