<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

// Register backend assets (CSS, JS)
AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <!-- Character encoding -->
    <meta charset="<?= Yii::$app->charset ?>">

    <!-- Responsive viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF meta tags for form security -->
    <?php $this->registerCsrfMetaTags() ?>

    <!-- Dynamic page title -->
    <title><?= Html::encode($this->title) ?></title>

    <!-- Head section (CSS, JS, meta) -->
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <!-- Main content area -->
    <main role="main">
        <div class="container">
            <!-- Render view content -->
            <?= $content ?>
        </div>
    </main>

    <!-- End body scripts -->
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>