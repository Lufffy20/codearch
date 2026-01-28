<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Award */

$this->title = 'Update Award: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Awards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="award-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>