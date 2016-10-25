<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 09.10.16
 * Time: 16:08
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doctor')->label('Doctor:')->dropdownList(
            User::find()->select(['name'])->joinWith('doctor')->indexBy('doctorId')->where(['group' => 'DOCTOR'])->column(),
            ['prompt'=>'Select Doctor']
        ) ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'group')->hiddenInput()->label(false)?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>