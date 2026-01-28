<?php

use yii\db\Migration;

/**
 * Class m260127_071551_add_address_and_summary_to_personal_details
 */
class m260127_071551_add_address_and_summary_to_personal_details extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%personal_details}}', 'address', $this->text()->after('location'));
        $this->addColumn('{{%personal_details}}', 'summary', $this->text()->after('address'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%personal_details}}', 'summary');
        $this->dropColumn('{{%personal_details}}', 'address');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260127_071551_add_address_and_summary_to_personal_details cannot be reverted.\n";

        return false;
    }
    */
}
