<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 11.10.16
 * Time: 16:32
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading">' . $visit->date . " " . $visit->patient->user->name . '</div>';
    echo '<div class="panel-body">';
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php
    echo '</div>';
    echo '</div>';
?>
