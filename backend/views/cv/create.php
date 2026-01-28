<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cv $cv */

$this->title = 'Create CV';
$this->params['breadcrumbs'][] = ['label' => 'My CVs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cv-create">

    <?= $this->render('_form', [
        'cv' => $cv,
        'personal' => $personal,
        'educations' => $educations,
        'experiences' => $experiences,
        'skills' => $skills,
        'socials' => $socials,
        'projects' => $projects,
        'achievements' => $achievements,
        'languages' => $languages,
        'awards' => $awards,
        'courses' => $courses,
    ]) ?>


</div>