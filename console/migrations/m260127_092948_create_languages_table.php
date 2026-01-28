<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%languages}}`.
 */
class m260127_092948_create_languages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%languages}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'proficiency' => $this->string(50), // Beginner / Intermediate / Fluent
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-languages-cv_id',
            '{{%languages}}',
            'cv_id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%languages}}');
    }
}
