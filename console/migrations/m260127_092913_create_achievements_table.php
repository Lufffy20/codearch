<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%achievements}}`.
 */
class m260127_092913_create_achievements_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%achievements}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'year' => $this->string(10),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-achievements-cv_id',
            '{{%achievements}}',
            'cv_id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%achievements}}');
    }
}
