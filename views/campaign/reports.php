<div class="col-lg-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h4 class="text-center text-white">Landing page visits</h4>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card text-white border border-danger">
                <div class="card-body">
                    <?php $web_visits   = 0; ?>
                    <?php foreach ($landing_page_visits as $tracker_short_code => $data): ?>
                        <?php $web_visits += count($landing_page_visits[$tracker_short_code]) ?>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class=""><?= $tracker_short_code ?></h6>
                                </div>
                                <div class="col-lg-4">
                                    <h6> <?= count($landing_page_visits[$tracker_short_code]) ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <h6 class="text-success">Web visits</h6>
                            </div>
                            <div class="col-lg-4">
                                <h6> <?= $web_visits ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h4 class="text-center text-white">Coupon issued</h4>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card text-white border border-danger">
                <div class="card-body">
                    <?php $coupon_issued_count = 0; ?>
                    <?php foreach ($coupon_issued_list as $tracker_short_code => $data): ?>
                        <?php $coupon_issued_count += count($coupon_issued_list[$tracker_short_code]) ?>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class=""><?= $tracker_short_code ?></h6>
                                </div>
                                <div class="col-lg-4">
                                    <h6> <?= count($coupon_issued_list[$tracker_short_code]) ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <h6 class="text-success">Coupon issued</h6>
                            </div>
                            <div class="col-lg-4">
                                <h6> <?= $coupon_issued_count ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h4 class="text-center text-white">Coupon details view</h4>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card text-white border border-danger">
                <div class="card-body">
                    <?php $web_visits   = 0; ?>
                    <?php foreach ($coupon_details_view as $tracker_short_code => $data): ?>
                        <?php $web_visits += count($coupon_details_view[$tracker_short_code]) ?>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class=""><?= $tracker_short_code ?></h6>
                                </div>
                                <div class="col-lg-4">
                                    <h6> <?= count($coupon_details_view[$tracker_short_code]) ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <h6 class="text-success">Web visits</h6>
                            </div>
                            <div class="col-lg-4">
                                <h6> <?= $web_visits ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h4 class="text-center text-white">Redeem coupon</h4>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card text-white border border-danger">
                <div class="card-body">
                    <?php $coupon_redeem_count = 0; ?>
                    <?php foreach ($coupon_redeem_list as $tracker_short_code => $data): ?>
                        <?php $coupon_redeem_count += count($coupon_redeem_list[$tracker_short_code]) ?>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class=""><?= $tracker_short_code ?></h6>
                                </div>
                                <div class="col-lg-4">
                                    <h6> <?= count($coupon_redeem_list[$tracker_short_code]) ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <h6 class="text-success">Coupon redeem</h6>
                            </div>
                            <div class="col-lg-4">
                                <h6> <?= $coupon_redeem_count ?></h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <h6 class="text-danger">Coupons not redeem</h6>
                            </div>
                            <div class="col-lg-4">
                                <h6> <?= $coupon_not_redeem_count = $coupon_issued_count - $coupon_redeem_count ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>