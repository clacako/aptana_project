<div class="row">
    <div class="col-lg-4">
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
                        <?php foreach ($visit_landing_page_activities as $tracker => $activity): ?>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4 class=""><?= ucwords($tracker) ?></h4>
                                    </div>
                                    <div class="col-lg-4">
                                        <h4> <?= count($visit_landing_page_activities[$tracker]) ?></h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h4 class="text-center text-white">Custom link</h4>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-12">
                <div class="card text-white border border-danger">
                    <div class="card-body">
                        <?php foreach ($custom_link_activities as $tracker_id => $activity): ?>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4 class=""><?= ucwords($tracker_id) ?></h4>
                                    </div>
                                    <div class="col-lg-4">
                                        <h4> <?= count($custom_link_activities[$tracker_id]) ?></h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h4 class="text-center text-white">Contact</h4>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-12">
                <div class="card text-white border border-danger">
                    <div class="card-body">
                        <?php foreach ($contact_activities as $tracker_id => $activity): ?>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4 class=""><?= ucwords($tracker_id) ?></h4>
                                    </div>
                                    <div class="col-lg-4">
                                        <h4> <?= count($contact_activities[$tracker_id]) ?></h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>