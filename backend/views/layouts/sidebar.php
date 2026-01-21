<?php

use yii\helpers\Url;
?>

<aside class="left-sidebar with-vertical">

    <!-- Logo -->
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="<?= Url::to(['/site/index']) ?>" class="text-nowrap logo-img">
            <img src="<?= Url::to('@web/assets1/images/logos/logo-light.svg') ?>" class="dark-logo">
            <img src="<?= Url::to('@web/assets1/images/logos/logo-dark.svg') ?>" class="light-logo">
        </a>

        <a href="javascript:void(0)" class="sidebartoggler ms-auto d-block d-xl-none">
            <i class="ti ti-x"></i>
        </a>
    </div>

    <div class="scroll-sidebar" data-simplebar>
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="mb-0">

                <li class="nav-small-cap">
                    <span class="hide-menu">Home</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link primary-hover-bg" href="<?= Url::to(['/site/index']) ?>">
                        <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu ps-1">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link success-hover-bg" href="<?= Url::to(['/site/dashboard2']) ?>">
                        <span class="aside-icon p-2 bg-success-subtle rounded-1">
                            <i class="ti ti-chart-line"></i>
                        </span>
                        <span class="hide-menu ps-1">Dashboard 2</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow indigo-hover-bg" href="javascript:void(0)">
                        <span class="aside-icon p-2 bg-indigo-subtle rounded-1">
                            <i class="ti ti-layout"></i>
                        </span>
                        <span class="hide-menu ps-1">Front Pages</span>
                    </a>

                    <ul class="collapse first-level">
                        <li class="sidebar-item"><a href="<?= Url::to(['/site/home']) ?>" class="sidebar-link">Homepage</a></li>
                        <li class="sidebar-item"><a href="<?= Url::to(['/site/about']) ?>" class="sidebar-link">About Us</a></li>
                        <li class="sidebar-item"><a href="<?= Url::to(['/site/blog']) ?>" class="sidebar-link">Blog</a></li>
                        <li class="sidebar-item"><a href="<?= Url::to(['/site/contact']) ?>" class="sidebar-link">Contact Us</a></li>
                        <li class="sidebar-item"><a href="<?= Url::to(['/site/pricing']) ?>" class="sidebar-link">Pricing</a></li>
                    </ul>
                </li>

            </ul>

            <!-- Profile -->
            <div class="fixed-profile mx-3 mt-3">
                <div class="card bg-primary-subtle shadow-none">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">

                            <div class="d-flex gap-3">
                                <img src="<?= Url::to('@web/assets1/images/profile/user-1.jpg') ?>"
                                    class="rounded-circle" width="45" height="45">

                                <div>
                                    <h6 class="mb-0"><?= Yii::$app->user->identity->username ?? 'Admin' ?></h6>
                                    <small>Admin</small>
                                </div>
                            </div>

                            <a href="<?= Url::to(['/site/logout']) ?>" data-method="post">
                                <i class="ti ti-logout fs-5"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

        </nav>
    </div>
</aside>