<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;

AppAsset::register($this);
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <!-- ================= SPIKE ROOT WRAPPER ================= -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical">

        <!-- ================= SIDEBAR ================= -->
        <?= $this->render('sidebar') ?>

        <!-- ================= BODY WRAPPER ================= -->
        <div class="body-wrapper">

            <!-- ================= HEADER ================= -->
            <?= $this->render('header') ?>

            <!-- ================= MAIN CONTENT ================= -->
            <div class="container-fluid">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>

        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>