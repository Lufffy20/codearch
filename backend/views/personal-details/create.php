<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PersonalDetails $model */

$this->title = 'Create Personal Details';
$this->params['breadcrumbs'][] = ['label' => 'Personal Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
