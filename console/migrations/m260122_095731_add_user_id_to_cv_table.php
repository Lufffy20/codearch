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
        // 1. Add column (nullable)
        $this->addColumn('{{%cv}}', 'user_id', $this->integer()->null()->after('id'));

        // 2. Ensure at least ONE user exists
        $userId = (new \yii\db\Query())
            ->from('{{%user}}')
            ->select('id')
            ->scalar();

        if (!$userId) {
            $this->insert('{{%user}}', [
                'username' => 'system',
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash('password'),
                'email' => 'system@example.com',
                'status' => 10,
                'created_at' => time(),
                'updated_at' => time(),
            ]);

            $userId = $this->db->getLastInsertID();
        }

        // 3. Update existing CV rows
        $this->update('{{%cv}}', ['user_id' => $userId]);

        // 4. Make NOT NULL
        $this->alterColumn('{{%cv}}', 'user_id', $this->integer()->notNull());

        // 5. Add FK
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
