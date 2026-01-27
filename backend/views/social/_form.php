<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Social $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="social-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Platform -->
    <?= $form->field($model, 'platform')
        ->textInput(['maxlength' => true, 'placeholder' => 'GitHub / LinkedIn / Twitter']) ?>

    <!-- URL -->
    <?= $form->field($model, 'url')
        ->input('url', ['placeholder' => 'https://...']) ?>

    <!-- Sort Order -->
    <?= $form->field($model, 'sort_order')
        ->input('number', ['min' => 0]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Add Social Link' : 'Update Social Link',
            ['class' => 'btn btn-success']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>