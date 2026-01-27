<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Education $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">

            <div class="card">
                <div class="px-4 py-3 border-bottom text-center">
                    <h4 class="card-title mb-0">
                        <?= $model->isNewRecord ? 'Add Education' : 'Update Education' ?>
                    </h4>
                </div>

                <div class="card-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <!-- Degree -->
                    <div class="mb-4 row align-items-center">
                        <label class="form-label col-sm-3 col-form-label">Degree</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'degree', [
                                'template' => '{input}{error}',
                            ])->textInput([
                                'class' => 'form-control',
                                'maxlength' => true,
                                'placeholder' => 'B.Tech / BCA / MCA'
                            ])->label(false) ?>
                        </div>
                    </div>

                    <!-- Institute -->
                    <div class="mb-4 row align-items-center">
                        <label class="form-label col-sm-3 col-form-label">Institute</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'institute', [
                                'template' => '{input}{error}',
                            ])->textInput([
                                'class' => 'form-control',
                                'maxlength' => true,
                                'placeholder' => 'XYZ University'
                            ])->label(false) ?>
                        </div>
                    </div>

                    <!-- Year -->
                    <div class="mb-4 row align-items-center">
                        <label class="form-label col-sm-3 col-form-label">Year</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'year', [
                                'template' => '{input}{error}',
                            ])->textInput([
                                'class' => 'form-control',
                                'maxlength' => true,
                                'placeholder' => '2021 - 2024'
                            ])->label(false) ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <?= Html::submitButton(
                                $model->isNewRecord ? 'Add Education' : 'Update Education',
                                ['class' => 'btn btn-primary']
                            ) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>
</div>