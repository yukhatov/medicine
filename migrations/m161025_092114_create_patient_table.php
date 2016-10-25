<?php

use yii\db\Migration;

/**
 * Handles the creation for table `patient`.
 */
class m161025_092114_create_patient_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('patient', [
            'patientId' => $this->primaryKey(),
            'userId' => $this->integer()->unsigned()->notNull(),
            'doctorId' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->insert('patient', [
            'userId' => '3',
            'doctorId' => '1',
        ]);

        $this->insert('patient', [
            'userId' => '5',
            'doctorId' => '2',
        ]);

        $this->insert('patient', [
            'userId' => '6',
            'doctorId' => '1',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('patient');
    }
}
