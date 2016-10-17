<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 09.10.16
 * Time: 15:20
 */
use yii\helpers\Html;
?>
<p>You have entered the following information:</p>

<ul>
    <li><label>Username</label>: <?= Html::encode($model->username) ?></li>
    <li><label>Password</label>: <?= Html::encode($model->password) ?></li>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Specialization</label>: <?= Html::encode($model->specialization) ?></li>
</ul>
