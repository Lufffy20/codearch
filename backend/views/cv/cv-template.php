<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $this yii\web\View */
/** @var $html string */
/** @var $css string */
/** @var $cvId integer */

$this->title = 'CV Preview';
?>

<style>
<?= $css ?>
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
        <h4 class="fw-semibold mb-0">
            <?= Html::encode($this->title) ?>
        </h4>
        
        <div class="d-flex gap-2">
            <?= Html::a(
                '<i class="ti ti-arrow-left me-1"></i> Back to Edit',
                ['update', 'id' => $cvId],
                ['class' => 'btn btn-outline-secondary']
            ) ?>
            
            <?= Html::a(
                '<i class="ti ti-download me-1"></i> Download PDF',
                ['download', 'id' => $cvId, 'template' => 1],
                [
                    'class' => 'btn btn-primary',
                    'target' => '_blank'
                ]
            ) ?>
            
            <?= Html::a(
                '<i class="ti ti-palette me-1"></i> Change Template',
                ['templates', 'id' => $cvId],
                ['class' => 'btn btn-outline-info']
            ) ?>
        </div>
    </div>
    
    <div class="cv-container">
        <?= $html ?>
    </div>
</div>