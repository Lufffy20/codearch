<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="body-wrapper">
    <div class="container-fluid">

        <!-- ================= HEADER START ================= -->
        <header class="topbar sticky-top">

            <nav class="navbar navbar-expand-lg p-0">

                <!-- ================= Sidebar Toggle ================= -->
                <ul class="navbar-nav">
                    <li class="nav-item nav-icon-hover-bg rounded-circle">
                        <a class="nav-link sidebartoggler" href="javascript:void(0)">
                            <iconify-icon
                                icon="solar:list-bold-duotone"
                                class="fs-7">
                            </iconify-icon>
                        </a>
                    </li>
                </ul>

                <!-- ================= Desktop Navigation Menu ================= -->
                <ul class="navbar-nav quick-links d-none d-lg-flex align-items-center">

                    <!-- Apps Dropdown -->
                    <li class="nav-item dropdown hover-dd d-none d-lg-block me-2">
                        <a class="nav-link" href="javascript:void(0)">
                            Apps <i class="ti ti-chevron-down fs-3"></i>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0">
                            <div class="row">

                                <!-- Apps Section -->
                                <div class="col-8">
                                    <div class="ps-7 pt-7 border-bottom">
                                        <div class="row">

                                            <!-- Chat App -->
                                            <div class="col-6">
                                                <?= Html::a(
                                                    '<div class="bg-light-subtle rounded-1 me-3 p-6">
                                                        <img src="' . Url::to('@web/assets1/images/svgs/icon-dd-chat.svg') . '" width="24">
                                                     </div>
                                                     <div>
                                                        <h6>Chat Application</h6>
                                                        <span class="fs-2">New messages arrived</span>
                                                     </div>',
                                                    ['app/chat'],
                                                    ['class' => 'd-flex align-items-center pb-9']
                                                ) ?>
                                            </div>

                                            <!-- Calendar App -->
                                            <div class="col-6">
                                                <?= Html::a(
                                                    '<div class="bg-light-subtle rounded-1 me-3 p-6">
                                                        <img src="' . Url::to('@web/assets1/images/svgs/icon-dd-date.svg') . '" width="24">
                                                     </div>
                                                     <div>
                                                        <h6>Calendar</h6>
                                                        <span class="fs-2">Get dates</span>
                                                     </div>',
                                                    ['app/calendar'],
                                                    ['class' => 'd-flex align-items-center pb-9']
                                                ) ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Links Section -->
                                <div class="col-4 border-start p-6">
                                    <h5 class="fw-semibold mb-4">Quick Links</h5>

                                    <ul class="list-unstyled">
                                        <li>
                                            <?= Html::a('Pricing Page', ['site/pricing'], ['class' => 'fw-semibold']) ?>
                                        </li>
                                        <li>
                                            <?= Html::a('Register', ['site/signup'], ['class' => 'fw-semibold']) ?>
                                        </li>
                                        <li>
                                            <?= Html::a('404 Page', ['site/error'], ['class' => 'fw-semibold']) ?>
                                        </li>
                                        <li>
                                            <?= Html::a('Account Settings', ['user/settings'], ['class' => 'fw-semibold']) ?>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </li>

                    <!-- Direct Navigation Links -->
                    <li class="nav-item">
                        <?= Html::a('Chat', ['app/chat'], ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?= Html::a('Calendar', ['app/calendar'], ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?= Html::a('Email', ['app/email'], ['class' => 'nav-link']) ?>
                    </li>

                </ul>

                <!-- ================= Mobile Logo ================= -->
                <div class="d-block d-lg-none py-3">
                    <img
                        src="<?= Url::to('@web/assets1/images/logos/logo-light.svg') ?>"
                        class="dark-logo">
                    <img
                        src="<?= Url::to('@web/assets1/images/logos/logo-dark.svg') ?>"
                        class="light-logo">
                </div>

            </nav>
        </header>
        <!-- ================= HEADER END ================= -->