<?php

use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $cvs common\models\Cv[] */

$this->title = 'My CVs';
?>

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold mb-0">
            <?= Html::encode($this->title) ?>
        </h4>

        <?= Html::a(
            '<i class="ti ti-plus"></i> Create New CV',
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </div>

    <?php if (empty($cvs)) : ?>

        <div class="alert alert-info d-flex align-items-center">
            <i class="ti ti-info-circle me-2 fs-5"></i>
            <span>No CV found. Create your first CV 🚀</span>
        </div>

    <?php else : ?>

        <div class="row">

            <?php foreach ($cvs as $cv) : ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-semibold mb-0">
                                    <?= Html::encode($cv->title) ?>
                                </h6>
                                <span class="badge bg-primary-subtle text-primary">
                                    CV
                                </span>
                            </div>

                            <p class="text-muted mb-2 small">
                                Created on <?= Yii::$app->formatter->asDate($cv->created_at) ?>
                            </p>

                            <div class="border-top pt-3 mt-3 d-flex justify-content-between">

                                <?= Html::a(
                                    '<i class="ti ti-eye"></i>',
                                    ['cv', 'id' => $cv->id],
                                    [
                                        'class' => 'btn btn-sm btn-outline-primary',
                                        'title' => 'View CV',
                                    ]
                                ) ?>

                                <?= Html::a(
                                    '<i class="ti ti-edit"></i>',
                                    ['update', 'id' => $cv->id],
                                    [
                                        'class' => 'btn btn-sm btn-outline-warning',
                                        'title' => 'Edit CV',
                                    ]
                                ) ?>

                                <?= Html::a(
                                    '<i class="ti ti-trash"></i>',
                                    ['delete', 'id' => $cv->id],
                                    [
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'title' => 'Delete CV',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this CV?',
                                            'method' => 'post',
                                        ],
                                    ]
                                ) ?>

                            </div>

                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>