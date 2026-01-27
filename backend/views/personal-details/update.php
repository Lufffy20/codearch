<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PersonalDetails $model */

$this->title = 'Update Personal Details: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Personal Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="personal-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
