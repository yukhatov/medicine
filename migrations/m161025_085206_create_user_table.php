<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m161025_085206_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'userId' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'group' => $this->string()->notNull(),
        ]);

        $this->insert('user', [
            'username' => 'admin',
            'password' => '21232f297a57a5a743894a0e4a801fc3',
            'name' => 'John Doe',
            'group' => 'DOCTOR',
        ]);

        $this->insert('user', [
            'username' => 'admin1',
            'password' => 'e00cf25ad42683b3df678c61f42c6bda',
            'name' => 'Eddard Stark',
            'group' => 'DOCTOR',
        ]);

        $this->insert('user', [
            'username' => 'demo',
            'password' => 'fe01ce2a7fbac8fafaed7c982a04e229',
            'name' => 'Tirion Lanister',
            'group' => 'PATIENT',
        ]);

        $this->insert('user', [
            'username' => 'dog',
            'password' => 'c4ca4238a0b923820dcc509a6f75849b',
            'name' => 'Petir Beilish',
            'group' => 'DOCTOR',
        ]);

        $this->insert('user', [
            'username' => 'ghost',
            'password' => '71144850f4fb4cc55fc0ee6935badddf',
            'name' => 'Jon Snow',
            'group' => 'PATIENT',
        ]);

        $this->insert('user', [
            'username' => 'demo1',
            'password' => 'e368b9938746fa090d6afd3628355133',
            'name' => 'Robert Barateon',
            'group' => 'PATIENT',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
