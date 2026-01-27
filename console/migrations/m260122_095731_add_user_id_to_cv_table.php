<?php

use yii\db\Migration;

/**
 * Class m260122_095731_add_user_id_to_cv_table
 */
class m260122_095731_add_user_id_to_cv_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Step 1: user_id column (pehle NULL allow)
        $this->addColumn(
            '{{%cv}}',
            'user_id',
            $this->integer()->null()->after('id')
        );

        // Step 2: existing data ke liye default user assign karo
        // NOTE: 1 ko apne existing admin/user ID se replace kar sakte ho
        $this->update('{{%cv}}', ['user_id' => 2]);

        // Step 3: ab NOT NULL karo
        $this->alterColumn('{{%cv}}', 'user_id', $this->integer()->notNull());

        // Step 4: foreign key
        $this->addForeignKey(
            'fk-cv-user_id',
            '{{%cv}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-cv-user_id', '{{%cv}}');
        $this->dropColumn('{{%cv}}', 'user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260122_095731_add_user_id_to_cv_table cannot be reverted.\n";

        return false;
    }
    */
}
