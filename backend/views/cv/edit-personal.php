<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="card">
    <div class="card-body">
        <h4 class="mb-4">Edit Personal Details</h4>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'role')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

        <div class="mt-3">
            <?= Html::submitButton(
                '<i class="ti ti-device-floppy me-1"></i> Save Changes',
                ['class' => 'btn btn-primary']
            ) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>