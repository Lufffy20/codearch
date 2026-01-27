<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Experience $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="experience-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Company -->
    <?= $form->field($model, 'company')
        ->textInput(['maxlength' => true]) ?>

    <!-- Position -->
    <?= $form->field($model, 'position')
        ->textInput(['maxlength' => true]) ?>

    <!-- Duration -->
    <?= $form->field($model, 'duration')
        ->textInput(['maxlength' => true, 'placeholder' => 'Jan 2023 – Present']) ?>

    <!-- Description -->
    <?= $form->field($model, 'description')
        ->textarea(['rows' => 5]) ?>

    <!-- Sort Order -->
    <?= $form->field($model, 'sort_order')
        ->input('number', ['min' => 0]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Add Experience' : 'Update Experience',
            ['class' => 'btn btn-success']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>