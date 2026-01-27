<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $this yii\web\View */
/** @var $cv common\models\Cv */
/** @var $templates common\models\CvTemplate[] */

$this->title = 'Choose Template for ' . Html::encode($cv->title);
?>

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold mb-0">
            <?= Html::encode($this->title) ?>
        </h4>

        <?= Html::a(
            '<i class="ti ti-arrow-left"></i> Back to CV',
            ['cv', 'id' => $cv->id],
            ['class' => 'btn btn-secondary btn-sm']
        ) ?>
    </div>

    <!-- Templates Grid -->
    <div class="row g-4">
        <?php foreach ($templates as $template): ?>
            <div class="col-xl-4 col-lg-6 col-md-6">

                <div class="cv-template-card
                    <?= $cv->template_id == $template->id ? 'active' : '' ?>">

                    <!-- 🔥 LIVE CV THUMBNAIL -->
                    <div class="cv-preview">
                        <iframe
                            src="<?= Url::to([
                                        'thumbnail',
                                        'id' => $cv->id,
                                        'template_id' => $template->id
                                    ]) ?>"
                            loading="lazy">
                        </iframe>
                    </div>

                    <!-- TEMPLATE NAME -->
                    <div class="cv-template-footer">
                        <?= Html::encode($template->name) ?>
                    </div>

                    <!-- ACTIONS -->
                    <div class="cv-template-actions">

                        <?= Html::a(
                            'Preview',
                            ['preview', 'id' => $cv->id, 'template_id' => $template->id],
                            [
                                'class' => 'btn btn-outline-primary btn-sm preview-btn',
                                'data' => [
                                    'bs-toggle' => 'modal',
                                    'bs-target' => '#previewModal'
                                ]
                            ]
                        ) ?>

                        <?= Html::a(
                            $cv->template_id == $template->id ? 'Selected' : 'Use Template',
                            ['templates', 'id' => $cv->id],
                            [
                                'class' => $cv->template_id == $template->id
                                    ? 'btn btn-success btn-sm disabled'
                                    : 'btn btn-primary btn-sm',
                                'data' => [
                                    'method' => 'post',
                                    'params' => ['template_id' => $template->id]
                                ]
                            ]
                        ) ?>

                        <?= Html::a(
                            'Download',
                            ['download', 'id' => $cv->id, 'template_id' => $template->id],
                            [
                                'class' => 'btn btn-outline-success btn-sm',
                                'data-pjax' => 0
                            ]
                        ) ?>

                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Template Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="preview-content" class="text-center py-5">
                    <div class="spinner-border"></div>
                    <p class="mt-2 text-muted">Loading preview…</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).on('click', '.preview-btn', function(e) {
    e.preventDefault();
    const url = $(this).attr('href');

    $('#preview-content').html(`
        <div class="text-center py-5">
            <div class="spinner-border"></div>
            <p class="mt-2 text-muted">Loading preview…</p>
        </div>
    `);

    $.get(url)
        .done(function(data) {
            $('#preview-content').html(data);
        })
        .fail(function() {
            $('#preview-content').html(
                '<div class="alert alert-danger">Failed to load preview</div>'
            );
        });
});
JS;

$this->registerJs($js);
?>

<style>
    .cv-preview {
        height: 360px;
        background: #f4f4f4;
        overflow: hidden;
        position: relative;
    }

    /* ✅ FIXED IFRAME */
    .cv-preview iframe {
        width: 794px;
        /* A4 width */
        height: 1123px;
        /* A4 height */
        border: none;

        position: absolute;
        top: 10px;
        left: 50%;

        transform: translateX(-50%) scale(0.23);
        transform-origin: top center;

        pointer-events: none;
    }

    .cv-template-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
        overflow: hidden;
        transition: .25s ease;
        max-width: 340px;
        margin: auto;
    }

    .cv-template-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 40px rgba(0, 0, 0, .12);
    }

    .cv-template-footer {
        padding: 10px;
        text-align: center;
        font-weight: 600;
        border-top: 1px solid #eee;
    }

    .cv-template-actions {
        display: flex;
        gap: 10px;
        padding: 12px;
        justify-content: center;
    }
</style>