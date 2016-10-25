<?php

use yii\db\Migration;

/**
 * Handles the creation for table `visit`.
 */
class m161025_092847_create_visit_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('visit', [
            'visitId' => $this->primaryKey(),
            'patientId' => $this->integer()->unsigned()->notNull(),
            'doctorId' => $this->integer()->unsigned()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'duration' => $this->integer()->unsigned()->notNull(),
            'isActive' => $this->smallInteger()->notNull(),
            'comment' => $this->string()->notNull(),
        ]);

        $this->insert('visit', [
            'patientId' => '1',
            'doctorId' => '1',
            'date' => '2016-10-13 17:00:00',
            'duration' => '60',
            'isActive' => '1',
            'comment' => 'Feeling good!',
        ]);

        $this->insert('visit', [
            'patientId' => '1',
            'doctorId' => '1',
            'date' => '2016-10-27 17:50:00',
            'duration' => '30',
            'isActive' => '1',
            'comment' => 'Feeling good!',
        ]);

        $this->insert('visit', [
            'patientId' => '2',
            'doctorId' => '2',
            'date' => '2016-10-21 15:55:00',
            'duration' => '60',
            'isActive' => '1',
            'comment' => 'Help, i was dead and now alive again',
        ]);

        $this->insert('visit', [
            'patientId' => '1',
            'doctorId' => '1',
            'date' => '2016-10-15 15:55:00',
            'duration' => '45',
            'isActive' => '1',
            'comment' => 'Help',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('visit');
    }
}
