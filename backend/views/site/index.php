<?php

use yii\helpers\Html;
?>

<div class="row">

    <!-- ================= LEFT CARDS ================= -->
    <div class="col-lg-3 d-flex align-items-stretch">
        <div class="w-100">

            <!-- Earning -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-1">Earning</h4>
                            <p class="card-subtitle">Last 7 Days</p>
                        </div>
                        <div class="text-end">
                            <h4 class="card-title mb-1">12,389</h4>
                            <span class="badge bg-warning-subtle text-warning border border-warning">-3.8%</span>
                        </div>
                    </div>

                    <div id="total-orders" class="my-1 mx-n6"></div>

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

            <!-- Latest Deal -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-1">Latest Deal</h4>
                            <p class="card-subtitle">Last 7 Days</p>
                        </div>
                        <span class="badge bg-success-subtle text-success border border-success">86.5%</span>
                    </div>

                    <div class="my-4">
                        <div class="d-flex justify-content-between">
                            <h5>$98,500</h5>
                            <h6>$1,22,900</h6>
                        </div>

                        <div class="progress my-2">
                            <div class="progress-bar bg-primary" style="width:80%"></div>
                        </div>

                        <p>Coupons used: 18/22</p>
                    </div>

                    <h6>Recent Purchasers</h6>
                    <ul class="hstack mb-0">
                        <?php for ($i = 2; $i <= 5; $i++): ?>
                            <li class="ms-n2">
                                <?= Html::img("@web/assets1/images/profile/user-$i.jpg", [
                                    'class' => 'rounded-circle border border-2 border-white',
                                    'width' => 40
                                ]) ?>
                            </li>
                        <?php endfor; ?>
                        <li class="ms-n2">
                            <span class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center border border-2 border-white"
                                style="width:40px;height:40px">+8</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- ================= CENTER CARD ================= -->
    <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">

            <div class="card-body border-bottom position-relative">
                <h4>Congratulations Mike</h4>
                <p>You have done 38% more sales</p>

                <ul class="list-unstyled mt-4">
                    <li class="d-flex mb-4">
                        <div class="bg-success-subtle rounded-circle p-3 me-3">
                            <iconify-icon icon="solar:cart-5-line-duotone"></iconify-icon>
                        </div>
                        <div>
                            <h6>64 new orders</h6>
                            <p>Processing</p>
                        </div>
                    </li>

                    <li class="d-flex mb-4">
                        <div class="bg-warning-subtle rounded-circle p-3 me-3">
                            <iconify-icon icon="solar:pause-line-duotone"></iconify-icon>
                        </div>
                        <div>
                            <h6>4 orders</h6>
                            <p>On hold</p>
                        </div>
                    </li>

                    <li class="d-flex">
                        <div class="bg-indigo-subtle rounded-circle p-3 me-3">
                            <iconify-icon icon="solar:bicycling-round-bold-duotone"></iconify-icon>
                        </div>
                        <div>
                            <h6>12 orders</h6>
                            <p>Delivered</p>
                        </div>
                    </li>
                </ul>

                <div class="man-working-on-laptop">
                    <?= Html::img('@web/assets1/images/backgrounds/man-working-on-laptop.png', [
                        'class' => 'img-fluid'
                    ]) ?>
                </div>
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>Total Orders</h4>
                        <p>Weekly Order Updates</p>
                    </div>
                    <select class="form-select w-auto">
                        <option>This Week</option>
                        <option>April 2024</option>
                        <option>May 2024</option>
                    </select>
                </div>

                <div id="netsells" class="mx-n6"></div>
            </div>

        </div>
    </div>

    <!-- ================= RIGHT CARDS ================= -->
    <div class="col-lg-3 d-flex align-items-stretch">
        <div class="w-100">

            <div class="card">
                <div class="card-body">
                    <h4>Profit</h4>
                    <h4 class="text-end">432</h4>
                    <span class="badge bg-success-subtle text-success">+26.5%</span>
                    <div id="products" class="my-4"></div>
                    <p class="text-center">$18k Profit more than last years</p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4>Customers</h4>
                    <h4 class="text-end">6,380</h4>
                    <span class="badge bg-success-subtle text-success">+26.5%</span>
                    <div id="customers" class="my-4"></div>
                </div>
            </div>

        </div>
    </div>

</div>