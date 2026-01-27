<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Experience $model */

$this->title = 'Create Experience';
$this->params['breadcrumbs'][] = ['label' => 'Experiences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experience-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
