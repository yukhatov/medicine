<?php

use yii\db\Migration;

/**
 * Handles the creation for table `access`.
 */
class m161025_094518_create_access_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('access', [
            'accessId' => $this->primaryKey(),
            'who' => $this->integer()->notNull()->unsigned(),
            'for' => $this->integer()->notNull()->unsigned(),
        ]);

        $this->insert('access', [
            'who' => '2',
            'for' => '1',
        ]);

        $this->insert('access', [
            'who' => '2',
            'for' => '3',
        ]);

        $this->insert('access', [
            'who' => '1',
            'for' => '3',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('access');
    }
}
