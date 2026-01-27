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
        'cv' => $cv,
        'personal' => $personal,
        'educations' => $educations,
        'experiences' => $experiences,
        'skills' => $skills,
        'socials' => $socials,
    ]) ?>

</div>