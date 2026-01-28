<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Import Resume';
$this->params['breadcrumbs'][] = ['label' => 'CVs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid my-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mx-3">
                <div class="px-4 py-2 border-bottom">
                    <h5 class="mb-0">Import Resume</h5>
                </div>

                <div class="card-body">
                    <p class="text-muted">Upload your existing resume (PDF, DOC, DOCX, or TXT) to automatically populate your CV fields.</p>

                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data'],
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label fw-semibold'],
                            'inputOptions' => ['class' => 'form-control form-control-sm'],
                            'errorOptions' => ['class' => 'text-danger small'],
                        ],
                    ]); ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $form->field($cv, 'title')->textInput([
                                'placeholder' => 'Enter CV Title',
                                'value' => 'Imported CV - ' . date('Y-m-d')
                            ])->label('CV Title') ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Upload Resume File</label>
                            <input type="file" name="resume_file" class="form-control form-control-sm" accept=".pdf,.doc,.docx,.txt" required>
                            <div class="form-text">
                                Supported formats: PDF, DOC, DOCX, TXT (Max 5MB)
                            </div>
                        </div>

                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                            <div class="alert alert-danger">
                                <?= Yii::$app->session->getFlash('error') ?>
                            </div>
                        <?php endif; ?>

                        <div class="d-flex justify-content-end align-items-center gap-2 mt-4">
                            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                            <?= Html::submitButton('Import Resume', ['class' => 'btn btn-primary btn-sm']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $this->registerCss("
.cursor-pointer {
    cursor: pointer;
}
.template-radio:checked + label {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}
");
    ?>