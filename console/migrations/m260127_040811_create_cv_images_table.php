<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cv_images}}`.
 */
class m260127_040811_create_cv_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cv_images}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cv_images}}');
    }
}
