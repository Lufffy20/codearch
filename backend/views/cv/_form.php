<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

AppAsset::register($this);

// Get active tab from GET parameter, default to 'personal'
$activeTab = Yii::$app->request->get('tab', 'personal');

?>
<div class="container-fluid my-4">
    <div class="row">
        <div class="col-12">

            <div class="cv-form-container">
                <!-- Enhanced Header -->
                <div class="cv-form-header">
                    <h5>
                        <i class="ti ti-file-text"></i>
                        <?= $cv->isNewRecord ? 'Create New CV' : 'Update CV' ?>
                    </h5>

                    <?php if ($cv->isNewRecord): ?>
                        <?= Html::a(
                            '<i class="ti ti-upload"></i> Import Resume',
                            ['import'],
                            ['class' => 'btn']
                        ) ?>
                    <?php endif; ?>
                </div>

                <div class="cv-form-body">
                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data'],
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'text-danger'],
                        ],
                    ]); ?>

                    <!-- Vertical Tabs Layout -->
                    <div class="vertical-tabs-wrapper">

                        <!-- Left Side: Vertical Navigation -->
                        <ul class="nav nav-tabs nav-tabs-vertical" id="cvFormTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'personal' ? 'active' : '' ?>"
                                    id="personal-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#personal"
                                    data-tab-name="personal"
                                    type="button">
                                    <i class="ti ti-user"></i> Personal Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'education' ? 'active' : '' ?>"
                                    id="education-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#education"
                                    data-tab-name="education"
                                    type="button">
                                    <i class="ti ti-school"></i> Education
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'experience' ? 'active' : '' ?>"
                                    id="experience-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#experience"
                                    data-tab-name="experience"
                                    type="button">
                                    <i class="ti ti-briefcase"></i> Experience
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'skills' ? 'active' : '' ?>"
                                    id="skills-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#skills"
                                    data-tab-name="skills"
                                    type="button">
                                    <i class="ti ti-code"></i> Skills
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'social' ? 'active' : '' ?>"
                                    id="social-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#social"
                                    data-tab-name="social"
                                    type="button">
                                    <i class="ti ti-share"></i> Social Links
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'projects' ? 'active' : '' ?>"
                                    data-bs-toggle="tab"
                                    data-bs-target="#projects"
                                    data-tab-name="projects"
                                    type="button">
                                    <i class="ti ti-folder"></i> Projects
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'achievements' ? 'active' : '' ?>"
                                    data-bs-toggle="tab"
                                    data-bs-target="#achievements"
                                    data-tab-name="achievements"
                                    type="button">
                                    <i class="ti ti-trophy"></i> Achievements
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'languages' ? 'active' : '' ?>"
                                    data-bs-toggle="tab"
                                    data-bs-target="#languages"
                                    data-tab-name="languages"
                                    type="button">
                                    <i class="ti ti-language"></i> Languages
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'awards' ? 'active' : '' ?>"
                                    data-bs-toggle="tab"
                                    data-bs-target="#awards"
                                    data-tab-name="awards"
                                    type="button">
                                    <i class="ti ti-award"></i> Awards
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $activeTab == 'courses' ? 'active' : '' ?>"
                                    data-bs-toggle="tab"
                                    data-bs-target="#courses"
                                    data-tab-name="courses"
                                    type="button">
                                    <i class="ti ti-certificate"></i> Courses
                                </button>
                            </li>
                        </ul>

                        <!-- Right Side: Tab Content -->
                        <div class="tab-content tab-content-vertical" id="cvFormTabsContent">

                            <!-- PERSONAL DETAILS TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'personal' ? 'show active' : '' ?>" id="personal" role="tabpanel">
                                <div class="section-header">
                                    <h6><i class="ti ti-user"></i> Personal Information</h6>
                                    <p>Add your basic information and professional summary</p>
                                </div>

                                <div class="row">
                                    <!-- CV Title -->
                                    <div class="col-md-12 mb-3">
                                        <?= $form->field($cv, 'title')->textInput([
                                            'placeholder' => 'e.g., Software Developer CV - 2024'
                                        ]) ?>
                                        <div class="help-text">
                                            <i class="ti ti-info-circle"></i>
                                            Give your CV a descriptive title for easy identification
                                        </div>
                                    </div>

                                    <!-- Profile Photo Upload -->
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label">Profile Photo</label>
                                        <div class="profile-photo-section">
                                            <div class="row align-items-center">
                                                <div class="col-md-8">
                                                    <?= Html::fileInput('profile_image', null, [
                                                        'class' => 'form-control',
                                                        'accept' => 'image/*',
                                                        'id' => 'profile-image-upload'
                                                    ]) ?>
                                                    <div class="help-text mt-2">
                                                        <i class="ti ti-photo"></i>
                                                        JPG, PNG (Max 2MB) - Professional photo recommended
                                                    </div>
                                                    <div id="profile-image-error" class="text-danger" style="display:none;"></div>
                                                    <?php if (Yii::$app->session->hasFlash('error')): ?>
                                                        <div class="text-danger mt-2">
                                                            <i class="ti ti-alert-circle"></i>
                                                            <?= Yii::$app->session->getFlash('error') ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-4">
                                                    <?php if (!$cv->isNewRecord && $cv->profileImage): ?>
                                                        <div class="profile-preview-container">
                                                            <img src="<?= Yii::getAlias('@web') . $cv->profileImage->image_path ?>"
                                                                alt="Profile"
                                                                class="profile-preview-image">
                                                            <div class="form-check">
                                                                <?= Html::checkbox('remove_profile_image', false, [
                                                                    'class' => 'form-check-input',
                                                                    'value' => 1,
                                                                    'id' => 'remove-profile-image'
                                                                ]) ?>
                                                                <?= Html::label('Remove', 'remove-profile-image', ['class' => 'form-check-label']) ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="divider"></div>
                                    </div>

                                    <!-- Personal Information Fields -->
                                    <div class="col-md-6 mb-3">
                                        <?= $form->field($personal, 'name')->textInput([
                                            'placeholder' => 'Enter your full name'
                                        ]) ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <?= $form->field($personal, 'role')->textInput([
                                            'placeholder' => 'e.g., Full Stack Developer'
                                        ]) ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <?= $form->field($personal, 'email')->textInput([
                                            'placeholder' => 'your.email@example.com',
                                            'type' => 'email'
                                        ]) ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <?= $form->field($personal, 'phone')->textInput([
                                            'placeholder' => '+91 98765 43210'
                                        ]) ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <?= $form->field($personal, 'location')->textInput([
                                            'placeholder' => 'City, State, Country'
                                        ]) ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <?= $form->field($personal, 'address')->textarea([
                                            'rows' => 2,
                                            'placeholder' => 'Enter your full address'
                                        ]) ?>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <?= $form->field($personal, 'summary')->textarea([
                                            'rows' => 5,
                                            'placeholder' => 'Write a compelling professional summary that highlights your key strengths, experience, and career objectives...'
                                        ]) ?>
                                        <div class="help-text">
                                            <i class="ti ti-bulb"></i>
                                            Tip: Keep it concise (3-4 lines) and focus on what makes you unique
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- EDUCATION TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'education' ? 'show active' : '' ?>" id="education" role="tabpanel">
                                <div class="section-header">
                                    <h6><i class="ti ti-school"></i> Education History</h6>
                                    <p>Add your educational qualifications</p>
                                </div>

                                <div id="education-container">
                                    <?php foreach ($educations as $i => $edu): ?>
                                        <div class="entry-card education-entry">
                                            <div class="entry-card-header">
                                                <div class="entry-number"><?= $i + 1 ?></div>
                                                <?php if (count($educations) > 1): ?>
                                                    <button type="button" class="btn btn-remove" onclick="removeEducation(this)">
                                                        <i class="ti ti-trash"></i> Remove
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                            <?= Html::activeHiddenInput($edu, "[$i]id") ?>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Degree / Qualification</label>
                                                    <?= Html::activeTextInput($edu, "[$i]degree", [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'e.g., Bachelor of Computer Science'
                                                    ]) ?>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Institute / University</label>
                                                    <?= Html::activeTextInput($edu, "[$i]institute", [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'e.g., Gujarat University'
                                                    ]) ?>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Year / Duration</label>
                                                    <?= Html::activeTextInput($edu, "[$i]year", [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'e.g., 2019 - 2023'
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-add" onclick="addMoreEducation()">
                                    <i class="ti ti-plus"></i> Add More Education
                                </button>
                            </div>

                            <!-- EXPERIENCE TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'experience' ? 'show active' : '' ?>" id="experience" role="tabpanel">
                                <div class="section-header">
                                    <h6><i class="ti ti-briefcase"></i> Work Experience</h6>
                                    <p>Add your professional experience and achievements</p>
                                </div>

                                <div id="experience-container">
                                    <?php foreach ($experiences as $i => $exp): ?>
                                        <div class="entry-card experience-entry">
                                            <div class="entry-card-header">
                                                <div class="entry-number"><?= $i + 1 ?></div>
                                                <?php if (count($experiences) > 1): ?>
                                                    <button type="button" class="btn btn-remove" onclick="removeExperience(this)">
                                                        <i class="ti ti-trash"></i> Remove
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                            <?= Html::activeHiddenInput($exp, "[$i]id") ?>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Company Name</label>
                                                    <?= Html::activeTextInput($exp, "[$i]company", [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'e.g., Tech Solutions Inc.'
                                                    ]) ?>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Position / Role</label>
                                                    <?= Html::activeTextInput($exp, "[$i]position", [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'e.g., Senior Developer'
                                                    ]) ?>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Duration</label>
                                                    <?= Html::activeTextInput($exp, "[$i]duration", [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'e.g., Jan 2020 - Present'
                                                    ]) ?>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Description & Achievements</label>
                                                    <?= Html::activeTextarea($exp, "[$i]description", [
                                                        'class' => 'form-control',
                                                        'rows' => 4,
                                                        'placeholder' => 'Describe your key responsibilities, achievements, and impact in this role...'
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-add" onclick="addMoreExperience()">
                                    <i class="ti ti-plus"></i> Add More Experience
                                </button>
                            </div>

                            <!-- SKILLS TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'skills' ? 'show active' : '' ?>" id="skills" role="tabpanel">
                                <div class="section-header">
                                    <h6><i class="ti ti-code"></i> Skills & Technologies</h6>
                                    <p>List your technical and professional skills</p>
                                </div>

                                <div id="skills-container" class="skills-grid">
                                    <?php foreach ($skills as $i => $skill): ?>
                                        <?= Html::activeHiddenInput($skill, "[$i]id") ?>
                                        <div class="skill-item">
                                            <?= Html::activeTextInput($skill, "[$i]name", [
                                                'class' => 'form-control',
                                                'placeholder' => 'e.g., PHP, JavaScript, MySQL'
                                            ]) ?>
                                            <?php if (count($skills) > 1): ?>
                                                <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeSkill(this)">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-add mt-3" onclick="addMoreSkill()">
                                    <i class="ti ti-plus"></i> Add More Skill
                                </button>
                            </div>

                            <!-- SOCIAL LINKS TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'social' ? 'show active' : '' ?>" id="social" role="tabpanel">
                                <div class="section-header">
                                    <h6><i class="ti ti-share"></i> Social Links</h6>
                                    <p>Add your professional social media profiles</p>
                                </div>

                                <div id="social-container">
                                    <?php foreach ($socials as $i => $social): ?>
                                        <div class="entry-card social-entry">
                                            <div class="entry-card-header">
                                                <div class="entry-number"><?= $i + 1 ?></div>
                                                <?php if (count($socials) > 1): ?>
                                                    <button type="button" class="btn btn-remove" onclick="removeSocial(this)">
                                                        <i class="ti ti-trash"></i> Remove
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                            <?= Html::activeHiddenInput($social, "[$i]id") ?>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Platform</label>
                                                    <?= Html::activeTextInput($social, "[$i]platform", [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'e.g., LinkedIn, GitHub, Twitter'
                                                    ]) ?>
                                                </div>
                                                <div class="col-md-8 mb-3">
                                                    <label class="form-label">Profile URL</label>
                                                    <?= Html::activeTextInput($social, "[$i]url", [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'e.g., https://linkedin.com/in/yourprofile'
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-add" onclick="addMoreSocial()">
                                    <i class="ti ti-plus"></i> Add More Social Link
                                </button>
                            </div>

                            <!-- PROJECTS TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'projects' ? 'show active' : '' ?>" id="projects">
                                <div class="section-header">
                                    <h6><i class="ti ti-folder"></i> Projects</h6>
                                    <p>Showcase your notable projects and contributions</p>
                                </div>

                                <div id="projects-container">
                                    <?php foreach ($projects as $i => $project): ?>
                                        <div class="entry-card">
                                            <div class="entry-card-header">
                                                <div class="entry-number"><?= $i + 1 ?></div>
                                            </div>
                                            <?= Html::activeHiddenInput($project, "[$i]id") ?>
                                            <div class="mb-3">
                                                <label class="form-label">Project Title</label>
                                                <?= Html::activeTextInput($project, "[$i]title", [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'e.g., E-commerce Platform'
                                                ]) ?>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <?= Html::activeTextarea($project, "[$i]description", [
                                                    'class' => 'form-control',
                                                    'rows' => 3,
                                                    'placeholder' => 'Describe the project, your role, and its impact...'
                                                ]) ?>
                                            </div>
                                            <div>
                                                <label class="form-label">Technologies Used</label>
                                                <?= Html::activeTextInput($project, "[$i]tech_stack", [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'e.g., Laravel, MySQL, Vue.js'
                                                ]) ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-add" onclick="addMoreProject()">
                                    <i class="ti ti-plus"></i> Add Project
                                </button>
                            </div>

                            <!-- ACHIEVEMENTS TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'achievements' ? 'show active' : '' ?>" id="achievements">
                                <div class="section-header">
                                    <h6><i class="ti ti-trophy"></i> Achievements</h6>
                                    <p>Highlight your key accomplishments</p>
                                </div>

                                <div id="achievements-container">
                                    <?php foreach ($achievements as $i => $achievement): ?>
                                        <div class="entry-card">
                                            <div class="entry-card-header">
                                                <div class="entry-number"><?= $i + 1 ?></div>
                                            </div>
                                            <?= Html::activeHiddenInput($achievement, "[$i]id") ?>
                                            <div class="mb-3">
                                                <label class="form-label">Achievement Title</label>
                                                <?= Html::activeTextInput($achievement, "[$i]title", [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'e.g., Best Employee of the Year'
                                                ]) ?>
                                            </div>
                                            <div>
                                                <label class="form-label">Description</label>
                                                <?= Html::activeTextarea($achievement, "[$i]description", [
                                                    'class' => 'form-control',
                                                    'rows' => 2,
                                                    'placeholder' => 'Describe the achievement and its significance...'
                                                ]) ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-add" onclick="addMoreAchievement()">
                                    <i class="ti ti-plus"></i> Add Achievement
                                </button>
                            </div>

                            <!-- LANGUAGES TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'languages' ? 'show active' : '' ?>" id="languages">
                                <div class="section-header">
                                    <h6><i class="ti ti-language"></i> Languages</h6>
                                    <p>List the languages you speak</p>
                                </div>

                                <div id="languages-container" class="skills-grid">
                                    <?php foreach ($languages as $i => $lang): ?>
                                        <?= Html::activeHiddenInput($lang, "[$i]id") ?>

                                        <div class="skill-item d-flex gap-2 position-relative">
                                            <!-- Language Name -->
                                            <?= Html::activeTextInput($lang, "[$i]name", [
                                                'class' => 'form-control',
                                                'placeholder' => 'Language (e.g. English)'
                                            ]) ?>

                                            <!-- Proficiency -->
                                            <?= Html::activeDropDownList($lang, "[$i]proficiency", [
                                                'Beginner' => 'Beginner',
                                                'Intermediate' => 'Intermediate',
                                                'Fluent' => 'Fluent',
                                                'Native' => 'Native'
                                            ], [
                                                'class' => 'form-control',
                                                'prompt' => 'Proficiency'
                                            ]) ?>

                                            <!-- Remove -->
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="removeLanguage(this)">×</button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>


                                <button type="button" class="btn btn-add mt-3" onclick="addMoreLanguage()">
                                    <i class="ti ti-plus"></i> Add Language
                                </button>
                            </div>


                            <!-- AWARDS TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'awards' ? 'show active' : '' ?>" id="awards">
                                <div class="section-header">
                                    <h6><i class="ti ti-award"></i> Awards & Recognition</h6>
                                    <p>Add awards and recognitions you've received</p>
                                </div>

                                <div id="awards-container">
                                    <?php foreach ($awards as $i => $award): ?>
                                        <div class="entry-card">
                                            <div class="entry-card-header">
                                                <div class="entry-number"><?= $i + 1 ?></div>
                                            </div>
                                            <?= Html::activeHiddenInput($award, "[$i]id") ?>
                                            <label class="form-label">Award Title</label>
                                            <?= Html::activeTextInput($award, "[$i]title", [
                                                'class' => 'form-control',
                                                'placeholder' => 'e.g., Excellence in Innovation Award'
                                            ]) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-add" onclick="addMoreAward()">
                                    <i class="ti ti-plus"></i> Add Award
                                </button>
                            </div>

                            <!-- COURSES TAB -->
                            <div class="tab-pane fade <?= $activeTab == 'courses' ? 'show active' : '' ?>" id="courses">
                                <div class="section-header">
                                    <h6><i class="ti ti-certificate"></i> Courses & Certifications</h6>
                                    <p>Add relevant courses and certifications</p>
                                </div>

                                <div id="courses-container">
                                    <?php foreach ($courses as $i => $course): ?>
                                        <div class="entry-card">
                                            <div class="entry-card-header">
                                                <div class="entry-number"><?= $i + 1 ?></div>
                                            </div>
                                            <?= Html::activeHiddenInput($course, "[$i]id") ?>
                                            <label class="form-label">Course / Certification Name</label>
                                            <?= Html::activeTextInput($course, "[$i]title", [
                                                'class' => 'form-control',
                                                'placeholder' => 'e.g., AWS Certified Developer Associate'
                                            ]) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-add" onclick="addMoreCourse()">
                                    <i class="ti ti-plus"></i> Add Course
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- Enhanced Form Footer -->
                    <div class="form-footer">
                        <div>
                            <?php if (!$cv->isNewRecord): ?>
                                <?= Html::a(
                                    '<i class="ti ti-template"></i> Change Template',
                                    ['templates', 'id' => $cv->id],
                                    ['class' => 'btn btn-primary-custom']
                                ) ?>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?= Html::submitButton(
                                $cv->isNewRecord ? '<i class="ti ti-check"></i> Create CV' : '<i class="ti ti-device-floppy"></i> Save Changes',
                                ['class' => 'btn btn-success-custom']
                            ) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
$this->registerJs("
    window.cvCounters = {
        education: " . count($educations) . ",
        experience: " . count($experiences) . ",
        skill: " . count($skills) . ",
        social: " . count($socials) . ",
        projects: " . count($projects) . ",
        achievements: " . count($achievements) . ",
        languages: " . count($languages) . ",
        awards: " . count($awards) . ",
        courses: " . count($courses) . "
    };
", \yii\web\View::POS_HEAD);
