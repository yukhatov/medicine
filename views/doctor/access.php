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
        <p class="lead">Here you can manage access.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Doctors:</h2>

                <?php

                echo'<div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Doctors:</div>
                    <!-- Table -->
                    <table class="table table-bordered table-hover">
                        <theader class="center">
                            <th>Name</th>
                            <th>Action</th>
                        </theader>';

                foreach ($doctors as $doctor)
                {
                    echo'<tr>';
                    echo'<td>' . $doctor->user->name . ' - ' . $doctor->specialization . '</td>';
                    if($doctor->access)
                    {
                        echo'<td><a class="btn btn-warning col-lg-12" href="index.php?r=access/access&access=0&id=' . $doctor->doctorId . '">Reject</a></td>';
                    }else{
                        echo'<td><a class="btn btn-success col-lg-12" href="index.php?r=access/access&access=1&id=' . $doctor->doctorId . '">Access</a></td>';
                    }
                    echo'</tr>';
                }
                echo '
                    </table>
                </div>';
                ?>

            </div>
        </div>
    </div>

</div>
</div>


