<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PersonalDetails $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="personal-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Name -->
    <?= $form->field($model, 'name')
        ->textInput(['maxlength' => true]) ?>

    <!-- Role -->
    <?= $form->field($model, 'role')
        ->textInput(['maxlength' => true]) ?>

    <!-- Email -->
    <?= $form->field($model, 'email')
        ->input('email') ?>

    <!-- Phone -->
    <?= $form->field($model, 'phone')
        ->textInput(['maxlength' => true]) ?>

    <!-- Location -->
    <?= $form->field($model, 'location')
        ->textInput(['maxlength' => true]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton(
            'Update Personal Details',
            ['class' => 'btn btn-success']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>