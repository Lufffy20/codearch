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
    <div class="row g-5">
        <?php foreach ($templates as $template): ?>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">


                <div class="cv-template-item <?= $cv->template_id == $template->id ? 'active' : '' ?>">

                    <!-- TEMPLATE ITSELF (NO CARD BOX) -->
                    <div class="cv-paper">
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
                            '<i class="ti ti-download"></i>',
                            ['download', 'id' => $cv->id, 'template_id' => $template->id],
                            [
                                'class' => 'btn btn-outline-success btn-sm',
                                'title' => 'Download',
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