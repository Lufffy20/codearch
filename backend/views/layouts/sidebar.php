<?php

use yii\helpers\Url;

?>

<aside class="left-sidebar with-vertical">

    <!-- ================= Logo Section ================= -->
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="<?= Url::to(['/site/index']) ?>" class="text-nowrap logo-img">
            <img
                src="<?= Url::to('@web/assets1/images/logos/logo-light.svg') ?>"
                class="dark-logo">
            <img
                src="<?= Url::to('@web/assets1/images/logos/logo-dark.svg') ?>"
                class="light-logo">
        </a>

        <!-- Sidebar close button (mobile view) -->
        <a href="javascript:void(0)" class="sidebartoggler ms-auto d-block d-xl-none">
            <i class="ti ti-x"></i>
        </a>
    </div>

    <!-- ================= Sidebar Menu ================= -->
    <div class="scroll-sidebar" data-simplebar>
        <nav class="sidebar-nav">

            <ul id="sidebarnav" class="mb-0">

                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>

                <!-- Dashboard Menu Item -->
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link primary-hover-bg" href="<?= Url::to(['/site/index']) ?>" aria-expanded="false">
                        <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                            <iconify-icon icon="solar:screencast-2-line-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu ps-1">Dashboard</span>
                    </a>
                </li>

                <!-- CV Menu Item -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow indigo-hover-bg" href="javascript:void(0)" aria-expanded="false">
                        <span class="aside-icon p-2 bg-indigo-subtle rounded-1">
                            <iconify-icon icon="solar:smart-speaker-minimalistic-line-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu ps-1">CV</span>
                    </a>

                    <ul aria-expanded="false" class="collapse first-level">

                        <!-- CV View -->
                        <li class="sidebar-item">
                            <a href="<?= Url::to(['/cv/index']) ?>" class="sidebar-link">
                                <span class="sidebar-icon"></span>
                                <span class="hide-menu">My Cvs</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= Url::to(['/cv/create']) ?>" class="sidebar-link">
                                <span class="sidebar-icon"></span>
                                <span class="hide-menu">Create Cvs</span>
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>

            <!-- ================= Profile Section ================= -->
            <div class="fixed-profile mx-3 mt-3">
                <div class="card bg-primary-subtle shadow-none">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">

                            <!-- User Info -->
                            <div class="d-flex gap-3">
                                <img
                                    src="<?= Url::to('@web/assets1/images/profile/user-1.jpg') ?>"
                                    class="rounded-circle"
                                    width="45"
                                    height="45">

                                <div>
                                    <h6 class="mb-0">
                                        <?= Yii::$app->user->identity->username ?? 'Admin' ?>
                                    </h6>
                                    <small>Admin</small>
                                </div>
                            </div>

                            <!-- Logout Button -->
                            <a
                                href="<?= Url::to(['/site/logout']) ?>"
                                data-method="post">
                                <i class="ti ti-logout fs-5"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

        </nav>
    </div>
</aside>