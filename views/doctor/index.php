<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 11.10.16
 * Time: 15:35
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Hey Doctor  <?= $user->name ?></h1>
        <p class="lead">This is your doctor page.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Your patients:</h2>

               <?php
                    echo'<div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Patients:</div>
                        <!-- Table -->
                        <table class="table table-bordered table-hover">
                            <theader class="center">
                                <th>Name</th>
                                <th>Action</th>
                            </theader>';

                            foreach ($patients as $patient)
                            {
                                echo'<tr>';
                                    echo'<td>' . $patient->user->name . '</td>';
                                    echo'<td><a class="btn btn-info col-lg-12" href="index.php?r=doctor/patient-visits&id=' . $patient->patientId . '">Visits</a></td>';
                                echo'</tr>';
                            }
                        echo '
                        </table>
                    </div>';
                ?>

            </div>
            <div class="col-lg-6">
                <h2>Your schedule: ( <?=$hours?> hours) For:</h2>

                <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'date')->widget(\kartik\daterange\DateRangePicker::className(), [
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

                <?php

                if($visits)
                {
                    foreach ($visits as $visit)
                    {
                        if($visit->isActive)
                        {
                            echo '<div class="panel panel-default">';
                            echo '<div class="panel-heading">' . $visit->date . " " . $visit->patient->user->name . ' <a class="btn btn-warning" href="index.php?r=visit/visit-status&id='. $visit->visitId .'&status=0">Cancel</a> <a class="btn btn-info navbar-right" href="index.php?r=visit/edit-comment&id='. $visit->visitId .'">Edit comment</a></div>';
                            echo '<div class="panel-body">';
                            echo '<p>' . $visit->comment . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }else{
                            echo '<div class="panel panel-default">';
                            echo '<div class="panel-heading">' . $visit->date  . " " . $visit->patient->user->name .' <a class="btn btn-success" href="index.php?r=visit/visit-status&id='. $visit->visitId .'&status=1">Approve</a> <a class="btn btn-info navbar-right" href="index.php?r=visit/edit-comment&id='. $visit->visitId .'">Edit comment</a></div>';
                            echo '<div class="panel-body">';
                            echo '<p>' . $visit->comment . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }
                else{
                    echo '<p class="lead">You have no visits planned.</p>';
                }

                echo '<p><a class="btn btn-lg btn-info col-lg-12" href="index.php?r=doctor/schedules">See all schedules</a></p>';
                echo '<p style="padding-top: 50px;"><a class="btn btn-lg btn-warning col-lg-12" href="index.php?r=doctor/access">Give access</a></p>';

                ?>

            </div>
        </div>
    </div>

</div>
</div>