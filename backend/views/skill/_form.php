<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Skill $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="skill-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Skill Name -->
    <?= $form->field($model, 'name')
        ->textInput(['maxlength' => true, 'placeholder' => 'PHP, Yii2, MySQL']) ?>

    <!-- Sort Order -->
    <?= $form->field($model, 'sort_order')
        ->input('number', ['min' => 0]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Add Skill' : 'Update Skill',
            ['class' => 'btn btn-success']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>