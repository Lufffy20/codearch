<?php

use yii\helpers\Html;
?>

<?php if (!empty($cvData)): ?>

    <!-- ================= PROFILE CARD ================= -->
    <div class="card mb-4">
        <div class="card-body text-center">
            <h2 class="mb-1 fw-bold">
                <?= Html::encode($cvData['personal']['name'] ?? '—') ?>
            </h2>
            <p class="text-muted mb-0">
                <?= Html::encode($cvData['personal']['role'] ?? '') ?>
            </p>
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
                                <li class="mb-2">
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
                        <h5 class="card-title mb-3">Experience</h5>

                        <?php foreach ($cvData['experience'] as $exp): ?>
                            <div class="mb-4">
                                <h6 class="mb-1 fw-semibold">
                                    <?= Html::encode($exp['position'] ?? '') ?>
                                </h6>
                                <p class="mb-1 text-muted">
                                    <?= Html::encode($exp['company'] ?? '') ?>
                                    <?php if (!empty($exp['duration'])): ?>
                                        • <?= Html::encode($exp['duration']) ?>
                                    <?php endif; ?>
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
                        <h5 class="card-title mb-3">Education</h5>

                        <?php foreach ($cvData['education'] as $edu): ?>
                            <div class="mb-3">
                                <h6 class="mb-1 fw-semibold">
                                    <?= Html::encode($edu['degree'] ?? '') ?>
                                </h6>
                                <p class="mb-0 text-muted">
                                    <?= Html::encode($edu['institute'] ?? '') ?>
                                    <?php if (!empty($edu['year'])): ?>
                                        • <?= Html::encode($edu['year']) ?>
                                    <?php endif; ?>
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