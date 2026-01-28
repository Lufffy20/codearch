<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cv $cv */

$this->title = 'Update CV';
$this->params['breadcrumbs'][] = ['label' => 'My CVs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cv-update">

    <?= $this->render('_form', [
        'cv'           => $cv,
        'personal'     => $personal,

        // Existing sections
        'educations'   => $educations,
        'experiences'  => $experiences,
        'skills'       => $skills,
        'socials'      => $socials,

        // ✅ NEW ADD-MORE SECTIONS
        'projects'     => $projects,
        'achievements' => $achievements,
        'languages'    => $languages,
        'awards'       => $awards,
        'courses'      => $courses,

        // Templates (agar use ho raha ho)
        'templates'    => $templates ?? [],
    ]) ?>

</div>