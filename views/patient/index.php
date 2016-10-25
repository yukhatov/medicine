<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 11.10.16
 * Time: 15:35
 */
$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Hey <?= $user->name ?></h1>

        <p class="lead">This is your client page.</p>

        <p><a class="btn btn-lg btn-success" href="index.php?r=patient/register-visit">Visit</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Your visits:</h2>

                <?php
                    foreach ($visits as $visit)
                    {
                        if($visit->isActive)
                        {
                            echo '<div class="panel panel-default">';
                            echo '<div class="panel-heading">' . $visit->date  . ' <a class="btn btn-warning" href="index.php?r=visit/visit-status&id='. $visit->visitId .'&status=0">Cancel</a></div>';
                            echo '<div class="panel-body">';
                                echo '<p>' . $visit->comment . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }else{
                            echo '<div class="panel panel-default">';
                            echo '<div class="panel-heading">' . $visit->date  . ' <a class="btn btn-success" href="index.php?r=visit/visit-status&id='. $visit->visitId .'&status=1">Approve</a></div>';
                            echo '<div class="panel-body">';
                                echo '<p>' . $visit->comment . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                ?>

                <p><a class="btn btn-default" href="index.php?r=patient/register-visit">Register for Doctor visit &raquo;</a></p>
            </div>

            <div class="col-lg-4">
                <h2>Your doctor:</h2>
                <?php
                    echo '<p>' . $doctor->user->name . ' - ' . $doctor->specialization . '</p>';
                ?>
            </div>

            </div>
        </div>

    </div>
</div>