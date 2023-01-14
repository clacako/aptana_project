<div class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card border border-secondary">
                <div class="card-body text-secondary">
                    <h3 class="card-title text-secondary text-center">Total Coupon Code : <?= number_format($coupon_code_count,0,"",".") ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border border-secondary">
                <div class="card-body text-secondary">
                    <h3 class="card-title text-secondary text-center">Total Duplicate Code : <?= number_format($coupon_code_duplicate_count,0,"",".") ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border border-secondary">
                <div class="card-body text-secondary">
                    <h3 class="card-title text-secondary text-center">Total Coupon Issued : <?= number_format($coupon_issued_count_,0,"",".") ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>