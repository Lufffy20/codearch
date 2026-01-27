<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var $model common\models\CvTemplate */

?>

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
        <?= $form->field($model, 'name')
            ->textInput(['placeholder' => 'Template Name']) ?>
    </div>

    <div class="col-md-6 mb-3">
        <?= $form->field($model, 'template_file')
            ->textInput(['placeholder' => 'example: modern.php']) ?>
    </div>

    <div class="col-md-12 mb-3">
        <?= $form->field($model, 'description')
            ->textarea([
                'rows' => 3,
                'placeholder' => 'Short description about this template'
            ]) ?>
    </div>

    <div class="col-md-6 mb-3">
        <?= $form->field($model, 'thumbnailFile')
            ->fileInput(['accept' => 'image/*']) ?>
    </div>

    <?php if (!$model->isNewRecord && $model->thumbnail_url): ?>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Current Thumbnail</label><br>
            <img src="http://localhost/crm2/backend/web<?= $model->thumbnail_url ?>"
                class="img-thumbnail"
                style="max-height:120px">
        </div>
    <?php endif; ?>

    <div class="col-md-4 mb-3">
        <?= $form->field($model, 'sort_order')
            ->input('number', ['min' => 0]) ?>
    </div>

    <div class="col-md-4 mb-3 pt-4">
        <?= $form->field($model, 'is_active')->checkbox() ?>
    </div>
</div>

<div class="d-flex justify-content-end mt-3">
    <?= Html::submitButton(
        $model->isNewRecord ? 'Create Template' : 'Update Template',
        ['class' => 'btn btn-success btn-sm px-4']
    ) ?>
</div>

<?php ActiveForm::end(); ?>