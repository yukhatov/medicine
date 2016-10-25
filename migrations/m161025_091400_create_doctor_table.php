<?php

use yii\db\Migration;

/**
 * Handles the creation for table `doctor`.
 */
class m161025_091400_create_doctor_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('doctor', [
            'doctorId' => $this->primaryKey(),
            'specialization' => $this->string()->notNull(),
            'userId' => $this->integer()->unsigned()->notNull(),
            'shiftId' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->insert('doctor', [
            'specialization' => 'Allergist',
            'userId' => '1',
            'shiftId' => '1',
        ]);

        $this->insert('doctor', [
            'specialization' => 'Dentist',
            'userId' => '2',
            'shiftId' => '2',
        ]);

        $this->insert('doctor', [
            'specialization' => 'Dentist',
            'userId' => '4',
            'shiftId' => '1',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('doctor');
    }
}
