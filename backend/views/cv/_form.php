<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

<div class="container-fluid my-4">
    <div class="row">
        <div class="col-12">

            <div class="card shadow-sm mx-3">
                <div class="px-4 py-2 border-bottom">
                    <h5 class="mb-0 text-center">
                        <?= $cv->isNewRecord ? 'Create CV' : 'Update CV' ?>
                    </h5>
                </div>

                <div class="card-body">

                    <?php $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label fw-semibold'],
                            'inputOptions' => ['class' => 'form-control form-control-sm'],
                            'errorOptions' => ['class' => 'text-danger small'],
                        ],
                    ]); ?>

                    <!-- ================= CV INFO ================= -->
                    <h6 class="mb-3">CV Info</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $form->field($cv, 'title')->textInput([
                                'placeholder' => 'Enter CV Title'
                            ]) ?>
                        </div>

                        <?php if (!empty($templates)): ?>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Template</label>
                                <div class="row g-2">
                                    <?php foreach ($templates as $template): ?>
                                        <div class="col-md-6">
                                            <label class="d-block border rounded p-2 text-center cursor-pointer <?= $cv->template_id == $template->id ? 'border-primary border-2' : '' ?>">
                                                <?= Html::radio('Cv[template_id]', $cv->template_id == $template->id, [
                                                    'value' => $template->id,
                                                    'class' => 'd-none template-radio',
                                                    'id' => 'template-' . $template->id
                                                ]) ?>
                                                <div class="mb-2">
                                                    <?php if ($template->thumbnail_url): ?>
                                                        <img src="<?= $template->thumbnail_url ?>"
                                                            alt="<?= Html::encode($template->name) ?>"
                                                            class="img-fluid rounded"
                                                            style="height: 60px; object-fit: cover;">
                                                    <?php else: ?>
                                                        <div class="bg-light d-flex align-items-center justify-content-center"
                                                            style="height: 60px;">
                                                            <i class="ti ti-template fs-4 text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <small class="fw-semibold"><?= Html::encode($template->name) ?></small>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <hr>

                    <!-- ================= PERSONAL DETAILS ================= -->
                    <h6 class="mb-3">Personal Details</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3"><?= $form->field($personal, 'name') ?></div>
                        <div class="col-md-4 mb-3"><?= $form->field($personal, 'role')->textInput(['placeholder' => 'Your Role']) ?></div>
                        <div class="col-md-4 mb-3"><?= $form->field($personal, 'email') ?></div>
                        <div class="col-md-4 mb-3"><?= $form->field($personal, 'phone') ?></div>
                        <div class="col-md-4 mb-3"><?= $form->field($personal, 'location') ?></div>
                    </div>

                    <hr>

                    <!-- ================= EDUCATION ================= -->
                    <h6 class="mb-3">Education</h6>
                    <?php foreach ($educations as $i => $edu): ?>
                        <div class="border rounded p-3 mb-3 ">
                            <?= Html::activeHiddenInput($edu, "[$i]id") ?>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <?= Html::activeTextInput($edu, "[$i]degree", [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Degree'
                                    ]) ?>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <?= Html::activeTextInput($edu, "[$i]institute", [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Institute'
                                    ]) ?>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <?= Html::activeTextInput($edu, "[$i]year", [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Year'
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <hr>

                    <!-- ================= EXPERIENCE ================= -->
                    <h6 class="mb-3">Experience</h6>
                    <?php foreach ($experiences as $i => $exp): ?>
                        <div class="border rounded p-3 mb-3">
                            <?= Html::activeHiddenInput($exp, "[$i]id") ?>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <?= Html::activeTextInput($exp, "[$i]company", [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Company'
                                    ]) ?>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <?= Html::activeTextInput($exp, "[$i]position", [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Position'
                                    ]) ?>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <?= Html::activeTextInput($exp, "[$i]duration", [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Duration'
                                    ]) ?>
                                </div>
                                <div class="col-md-12">
                                    <?= Html::activeTextarea($exp, "[$i]description", [
                                        'class' => 'form-control form-control-sm',
                                        'rows' => 2,
                                        'placeholder' => 'Work Description'
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <hr>

                    <!-- ================= SKILLS ================= -->
                    <h6 class="mb-3">Skills</h6>
                    <div class="row">
                        <?php foreach ($skills as $i => $skill): ?>
                            <?= Html::activeHiddenInput($skill, "[$i]id") ?>
                            <div class="col-md-3 mb-2">
                                <?= Html::activeTextInput($skill, "[$i]name", [
                                    'class' => 'form-control form-control-sm',
                                    'placeholder' => 'Skill'
                                ]) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <hr>

                    <!-- ================= SOCIAL LINKS ================= -->
                    <h6 class="mb-3">Social Links</h6>
                    <?php foreach ($socials as $i => $social): ?>
                        <div class="border rounded p-3 mb-3">
                            <?= Html::activeHiddenInput($social, "[$i]id") ?>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <?= Html::activeTextInput($social, "[$i]platform", [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Platform'
                                    ]) ?>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <?= Html::activeTextInput($social, "[$i]url", [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Profile URL'
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="d-flex justify-content-end align-items-center gap-2 mt-4">

                        <?php if (!$cv->isNewRecord): ?>
                            <?= Html::a(
                                'Change Template',
                                ['templates', 'id' => $cv->id],
                                ['class' => 'btn btn-outline-primary btn-sm']
                            ) ?>
                        <?php endif; ?>

                        <?= Html::submitButton(
                            $cv->isNewRecord ? 'Create CV' : 'Save Changes',
                            ['class' => 'btn btn-success btn-sm px-4']
                        ) ?>

                    </div>



                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>
</div>