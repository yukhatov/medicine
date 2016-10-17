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
        <h1>Hey Doctor  <?= $user->name ?></h1>
        <p class="lead">This is your doctor page.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2><?= $patient->user->name ?>'s visits:</h2>

                <?php
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
                ?>

            </div>
        </div>
    </div>

</div>
</div>

