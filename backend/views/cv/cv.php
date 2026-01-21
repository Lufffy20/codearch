<?php

use yii\helpers\Html;
?>

<?php if (!empty($cvData)): ?>

    <!-- ================= PROFILE HEADER ================= -->
    <div class="card mb-4">
        <div class="card-body text-center">

            <h2 class="fw-bold mb-1">
                <?= Html::encode($cvData['personal']['name'] ?? '—') ?>
            </h2>

            <p class="text-muted mb-2">
                <?= Html::encode($cvData['personal']['role'] ?? '') ?>
            </p>

            <p class="mb-1"><?= Html::encode($cvData['personal']['email'] ?? '') ?></p>
            <p class="mb-1"><?= Html::encode($cvData['personal']['phone'] ?? '') ?></p>
            <p class="mb-2"><?= Html::encode($cvData['personal']['location'] ?? '') ?></p>

            <?php if (!empty($cvData['summary'])): ?>
                <p class="mt-2">
                    <?= Html::encode($cvData['summary']) ?>
                </p>
            <?php endif; ?>

            <!-- ================= SOCIAL LINKS ================= -->
            <?php if (!empty($cvData['social'])): ?>
                <div class="d-flex justify-content-center gap-3 mt-3">

                    <?php if (!empty($cvData['social']['linkedin'])): ?>
                        <a href="<?= Html::encode($cvData['social']['linkedin']) ?>" target="_blank" class="text-primary">
                            <i class="ti ti-brand-linkedin fs-5"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($cvData['social']['github'])): ?>
                        <a href="<?= Html::encode($cvData['social']['github']) ?>" target="_blank" class="text-dark">
                            <i class="ti ti-brand-github fs-5"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($cvData['social']['portfolio'])): ?>
                        <a href="<?= Html::encode($cvData['social']['portfolio']) ?>" target="_blank" class="text-success">
                            <i class="ti ti-world fs-5"></i>
                        </a>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <!-- ================= DOWNLOAD PDF BUTTON ================= -->
            <div class="mt-4">
                <?= Html::a(
                    '<i class="ti ti-download me-1"></i> Download PDF',
                    ['cv/download'],
                    [
                        'class' => 'btn btn-primary btn-sm',
                        'target' => '_blank'
                    ]
                ) ?>
            </div>

        </div>
    </div>

    <div class="row">

        <!-- ================= LEFT COLUMN ================= -->
        <div class="col-lg-4">

            <!-- Skills -->
            <?php if (!empty($cvData['skills'])): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Skills</h5>

                        <ul class="list-unstyled mb-0">
                            <?php foreach ($cvData['skills'] as $skill): ?>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="ti ti-check text-success me-2"></i>
                                    <?= Html::encode($skill) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                </div>
            <?php endif; ?>

        </div>

        <!-- ================= RIGHT COLUMN ================= -->
        <div class="col-lg-8">

            <!-- Experience -->
            <?php if (!empty($cvData['experience'])): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Experience</h5>

                        <?php foreach ($cvData['experience'] as $exp): ?>
                            <div class="mb-4 pb-3 border-bottom">
                                <h6 class="fw-semibold mb-1">
                                    <?= Html::encode($exp['position'] ?? '') ?>
                                </h6>

                                <p class="text-muted mb-2">
                                    <?= Html::encode($exp['company'] ?? '') ?>
                                    <?= !empty($exp['duration']) ? ' • ' . Html::encode($exp['duration']) : '' ?>
                                </p>

                                <?php if (!empty($exp['description'])): ?>
                                    <p class="mb-0">
                                        <?= Html::encode($exp['description']) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            <?php endif; ?>

            <!-- Education -->
            <?php if (!empty($cvData['education'])): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Education</h5>

                        <?php foreach ($cvData['education'] as $edu): ?>
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-1">
                                    <?= Html::encode($edu['degree'] ?? '') ?>
                                </h6>

                                <p class="text-muted mb-0">
                                    <?= Html::encode($edu['institute'] ?? '') ?>
                                    <?= !empty($edu['year']) ? ' • ' . Html::encode($edu['year']) : '' ?>
                                </p>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>

<?php else: ?>

    <div class="alert alert-warning">
        No CV data found.
    </div>

<?php endif; ?>