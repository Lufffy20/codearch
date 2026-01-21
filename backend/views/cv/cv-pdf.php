<?php

use yii\helpers\Html;
?>

<h1><?= Html::encode($cvData['personal']['name'] ?? '') ?></h1>
<p><strong><?= Html::encode($cvData['personal']['role'] ?? '') ?></strong></p>

<hr>

<h3>Skills</h3>
<ul>
    <?php foreach ($cvData['skills'] ?? [] as $skill): ?>
        <li><?= Html::encode($skill) ?></li>
    <?php endforeach; ?>
</ul>

<h3>Experience</h3>
<?php foreach ($cvData['experience'] ?? [] as $exp): ?>
    <p>
        <strong><?= Html::encode($exp['position'] ?? '') ?></strong><br>
        <?= Html::encode($exp['company'] ?? '') ?>
        (<?= Html::encode($exp['duration'] ?? '') ?>)
    </p>
<?php endforeach; ?>

<h3>Education</h3>
<?php foreach ($cvData['education'] ?? [] as $edu): ?>
    <p>
        <strong><?= Html::encode($edu['degree'] ?? '') ?></strong><br>
        <?= Html::encode($edu['institute'] ?? '') ?>
        (<?= Html::encode($edu['year'] ?? '') ?>)
    </p>
<?php endforeach; ?>