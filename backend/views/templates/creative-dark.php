<?php

use yii\helpers\Html;

/** @var array $cvData */
?>
<div class="cv-wrapper">
    <h1><?= Html::encode($cvData['personal']['name']) ?></h1>
    <p><?= Html::encode($cvData['personal']['role']) ?></p>

    <hr>

    <h3>Experience</h3>
    <?php foreach ($cvData['experiences'] as $exp): ?>
        <div>
            <strong><?= Html::encode($exp['position']) ?></strong>
            - <?= Html::encode($exp['company']) ?>
        </div>
    <?php endforeach; ?>
</div>