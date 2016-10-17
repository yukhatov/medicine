<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\tests\MainTest;

class TestController extends Controller
{
    public function actionIndex()
    {
        $test = new MainTest();
        $test->testCalcHours();
    }
}
