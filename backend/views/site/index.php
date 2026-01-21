<?php

use yii\helpers\Html;

?>

<div class="row">

    <!-- ================= LEFT COLUMN (STATS CARDS) ================= -->
    <div class="col-lg-3 d-flex align-items-stretch">
        <div class="w-100">

            <!-- ================= EARNING CARD ================= -->
            <div class="card">
                <div class="card-body">

                    <!-- Header -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-1">Earning</h4>
                            <p class="card-subtitle">Last 7 Days</p>
                        </div>
                        <div class="text-end">
                            <h4 class="card-title mb-1">12,389</h4>
                            <span class="badge bg-warning-subtle text-warning border border-warning">
                                -3.8%
                            </span>
                        </div>
                    </div>

                    <!-- Chart Placeholder -->
                    <div id="total-orders" class="my-1 mx-n6"></div>

                    <!-- Percentage Breakdown -->
                    <div class="d-flex justify-content-between">
                        <p><i class="ti ti-circle text-primary me-2"></i>Wrappixel</p>
                        <p>52%</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p><i class="ti ti-circle text-light me-2"></i>Wrappixel</p>
                        <p>48%</p>
                    </div>

                </div>
            </div>

            <!-- ================= LATEST DEAL CARD ================= -->
            <div class="card w-100">
                <div class="card-body">

                    <!-- Header -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-1">Latest Deal</h4>
                            <p class="card-subtitle">Last 7 Days</p>
                        </div>
                        <div>
                            <span class="badge rounded-pill bg-success-subtle text-success border-success border">
                                86.5%
                            </span>
                        </div>
                    </div>

                    <!-- Deal Progress -->
                    <div class="my-6 py-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">$98,500</h5>
                            <h6 class="mb-0">$1,22,900</h6>
                        </div>

                        <div class="progress bg-light-subtle w-100 my-2">
                            <div
                                class="progress-bar text-bg-primary"
                                role="progressbar"
                                style="width: 80%;"
                                aria-valuenow="80"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>

                        <p class="mb-0">Coupons used: 18/22</p>
                    </div>

                    <!-- Recent Purchasers -->
                    <h6 class="mb-7">Recent Purchasers</h6>
                    <ul class="hstack mb-0">

                        <?php for ($i = 2; $i <= 5; $i++): ?>
                            <li class="ms-n2">
                                <?= Html::img(
                                    "@web/assets1/images/profile/user-$i.jpg",
                                    [
                                        'class' => 'rounded-circle border border-2 border-white',
                                        'width' => 40
                                    ]
                                ) ?>
                            </li>
                        <?php endfor; ?>

                        <li class="ms-n2">
                            <span
                                class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center border border-2 border-white"
                                style="width:40px;height:40px">
                                +8
                            </span>
                        </li>

                    </ul>

                </div>
            </div>

        </div>
    </div>

    <!-- ================= CENTER COLUMN (MAIN DASHBOARD) ================= -->
    <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">

            <!-- Congratulations Section -->
            <div class="card-body border-bottom position-relative">
                <h4 class="card-title mb-1">Congratulations Mike</h4>
                <p class="card-subtitle mb-0">You have done 38% more sales</p>

                <div class="mt-6">
                    <ul class="list-unstyled mb-0">

                        <!-- New Orders -->
                        <li class="d-flex align-items-center mb-9">
                            <div class="bg-success-subtle p-6 me-3 rounded-circle d-flex align-items-center justify-content-center">
                                <iconify-icon
                                    icon="solar:cart-5-line-duotone"
                                    class="fs-7 text-success">
                                </iconify-icon>
                            </div>
                            <div>
                                <h6 class="mb-1 fs-4">64 new orders</h6>
                                <p class="mb-0">Processing</p>
                            </div>
                        </li>

                        <!-- On Hold Orders -->
                        <li class="d-flex align-items-center mb-9">
                            <div class="bg-warning-subtle p-6 me-3 rounded-circle d-flex align-items-center justify-content-center">
                                <iconify-icon
                                    icon="solar:pause-line-duotone"
                                    class="fs-6 text-warning">
                                </iconify-icon>
                            </div>
                            <div>
                                <h6 class="mb-1 fs-4">4 orders</h6>
                                <p class="mb-0">On hold</p>
                            </div>
                        </li>

                        <!-- Delivered Orders -->
                        <li class="d-flex align-items-center">
                            <div class="bg-indigo-subtle p-6 me-3 rounded-circle d-flex align-items-center justify-content-center">
                                <iconify-icon
                                    icon="solar:bicycling-round-bold-duotone"
                                    class="fs-7 text-indigo">
                                </iconify-icon>
                            </div>
                            <div>
                                <h6 class="mb-1 fs-4">12 orders</h6>
                                <p class="mb-0">Delivered</p>
                            </div>
                        </li>

                    </ul>

                    <!-- Illustration Image -->
                    <div class="man-working-on-laptop">
                        <?= Html::img(
                            '@web/assets1/images/backgrounds/man-working-on-laptop.png',
                            ['class' => 'img-fluid']
                        ) ?>
                    </div>
                </div>
            </div>

            <!-- Total Orders Chart -->
            <div class="card-body pb-2">
                <div class="d-flex align-items-baseline justify-content-between">
                    <div>
                        <h4 class="card-title mb-1">Total Orders</h4>
                        <p class="card-subtitle mb-0">Weekly Order Updates</p>
                    </div>

                    <select class="form-select fw-bold w-auto shadow-none">
                        <option value="1">This Week</option>
                        <option value="2">April 2024</option>
                        <option value="3">May 2024</option>
                        <option value="4">June 2024</option>
                    </select>
                </div>

                <div id="netsells" class="mx-n6"></div>
            </div>

        </div>
    </div>

    <!-- ================= RIGHT COLUMN ================= -->
    <div class="col-lg-3 d-flex align-items-stretch">
        <div class="d-block w-100">

            <!-- Profit Card -->
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-1">Profit</h4>
                            <p class="card-subtitle">Years</p>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 text-end">432</h4>
                            <span class="badge rounded-pill bg-success-subtle text-success border-success border">
                                +26.5%
                            </span>
                        </div>
                    </div>

                    <div id="products" class="my-8"></div>
                    <p class="mb-0 text-center">$18k Profit more than last years</p>
                </div>
            </div>

            <!-- Customers Card -->
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-1">Customers</h4>
                            <p class="card-subtitle">Last 7 Days</p>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 text-end">6,380</h4>
                            <span class="badge rounded-pill bg-success-subtle text-success border-success border">
                                +26.5%
                            </span>
                        </div>
                    </div>

                    <div id="customers" class="my-5"></div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <p class="mb-0">April 07 - April 14</p>
                        <p class="mb-0">6,380</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0">Last Week</p>
                        <p class="mb-0">4,298</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>