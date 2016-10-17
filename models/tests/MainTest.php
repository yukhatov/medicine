<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 17.10.16
 * Time: 14:33
 */

namespace app\models\tests;

use PHPUnit_Framework_TestCase;
use app\models\Visit;

class MainTest extends PHPUnit_Framework_TestCase
{
    public function testCalcHours()
    {
        $visit = new Visit();
        $visit->duration = 60;

        $this->assertEquals(1, \app\controllers\DoctorController::calcHours([$visit]));
    }
}