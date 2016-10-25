<?php

use yii\db\Migration;

/**
 * Handles the creation for table `shift`.
 */
class m161025_093801_create_shift_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('shift', [
            'shiftId' => $this->primaryKey(),
            'timeShiftStarts' => $this->time()->notNull(),
            'timeShiftEnds' => $this->time()->notNull(),
            'daysPerWeek' => $this->smallInteger()->notNull()->unsigned(),
        ]);

        $this->insert('shift', [
            'timeShiftStarts' => '00:00:00',
            'timeShiftEnds' => '00:00:00',
            'daysPerWeek' => '3',
        ]);

        $this->insert('shift', [
            'timeShiftStarts' => '00:00:00',
            'timeShiftEnds' => '00:00:00',
            'daysPerWeek' => '5',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('shift');
    }
}
