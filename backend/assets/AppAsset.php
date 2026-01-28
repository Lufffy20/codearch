<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'assets1/css/styles.css',
        'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css',
        'css/cv-form.css',
        'css/template.css',
    ];
    public $js = [
        'js/cv-form.js',
        'js/template.js',
        // Library JS files
        'assets1/libs/apexcharts/dist/apexcharts.min.js',
        // 'assets1/libs/bootstrap/dist/js/bootstrap.bundle.min.js',
        // Dashboards
        'assets1/js/dashboards/dashboard.js',
        'assets1/libs/simplebar/dist/simplebar.min.js',
        'assets1/js/theme/app.init.js',
        'assets1/js/theme/theme.js',
        'assets1/js/theme/feather.min-1.js',
        'assets1/js/theme/app.min.js',
        'assets1/js/theme/sidebarmenu.js',
        'assets1/libs/jvectormap/jquery-jvectormap.min.js',
        'assets1/js/extra-libs/jvectormap/jquery-jvectormap-us-aea-en.js',

        // Theme
        // 'assets1/js/theme/app.init-1.js',
        // 'assets1/js/theme/app.min-1.js', 
        'https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
