<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 11.10.16
 * Time: 15:35
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Hey Doctor  <?= $user->name ?></h1>
        <p class="lead">This is schedules you have access to.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">

                <?php
                foreach ($visitsAll as $doctorsVisits) {
                    echo '<h2>' . $doctorsVisits['doctor']->user->name . '\'s visits:</h2>';
                    echo '<h3>for:</h3>';?>

                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'date')->widget(\kartik\daterange\DateRangePicker::className(), [
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                    <?php

                    foreach ($doctorsVisits['visits'] as $visit) {

                        echo '<div class="panel panel-default">';
                        echo '<div class="panel-heading">' . $visit->date . " " . $visit->patient->user->name . '</div>';
                        echo '<div class="panel-body">';
                        echo '<p>' . $visit->comment . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>

            </div>
            <div class="col-lg-6">

                <?php
                echo '<h2>All doctors shifts:</h2>';

                foreach ($doctors as $doctor) {

                    echo '<div class="panel panel-default">';
                    echo '<div class="panel-heading">' . $doctor->user->name . ' - ' . $doctor->specialization . '</div>';
                    echo '<div class="panel-body">';
                        echo '<p>Days per week: ' . $doctor->shift->daysPerWeek . '</p>';
                        echo '<p>Shift starts: ' . $doctor->shift->timeShiftStarts . '</p>';
                        echo '<p>Shift ends: ' . $doctor->shift->timeShiftEnds . '</p>';
                        echo '</div>';
                    echo '</div>';

                }
                ?>

            </div>
        </div>
    </div>

</div>
</div>


