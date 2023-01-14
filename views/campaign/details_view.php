<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?= $page_title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Lovvit.id is a tool for Brands to Manage Digital Campaigns" name="description" />
        <meta content="" name="aptana" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url() ?>assets/images/lovvit_logo.png" type="image/x-icon">

        <!-- Bootstrap Css -->
        <link href="<?= base_url() ?>assets/css/bootstrap-dark.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?= base_url() ?>assets/css/app-dark.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />

        <!-- third party css -->
        <link href="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- dropify -->
        <link href="<?= base_url() ?>assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="<?= base_url("Campaigns") ?>" class="logo logo-dark text-center">
                        <span class="logo-lg">
                            <img src="<?= base_url() ?>assets/images/logo-lovvit-id.png" alt="" height="16">
                        </span>
                        <span class="logo-sm">
                            <img src="<?= base_url() ?>assets/images/logo-box-lovvit-id.png" alt="" height="24">
                        </span>
                    </a>
                    <a href="<?= base_url("Campaigns") ?>" class="logo logo-light text-center">
                        <span class="logo-lg">
                            <img src="<?= base_url() ?>assets/images/logo-lovvit-id.png" alt="" height="24">
                        </span>
                        <span class="logo-sm">
                            <img src="<?= base_url() ?>assets/images/logo-box-lovvit-id.png" alt="" height="24">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                    <li>
                        <button class="button-menu-mobile disable-btn waves-effect">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <h3 class="page-title-main text-danger"><?= $header ?></h3>
                    </li>

                    <li>
                        <h4 class="page-title-main btn btn-sm btn-default waves-effect waves-light"><i class="fas fa-dot-circle <?= $font_class ?>"></i> <?= $status ?></h4>
                    </li>

                    <li>
                        <h4 class="page-title-main btn btn-sm btn-default waves-effect waves-light text-info"> <?= !empty($campaign["CampaignTypeText"]) ? $campaign["CampaignTypeText"] : "" ?></h4>
                    </li>
        
                </ul>

            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!-- User box -->
                    <div class="user-box text-center">
                        <img src="<?= base_url() ?>assets/images/blank-pic.png" alt="user-img" title="" class="rounded-circle img-thumbnail avatar-md">
                        <div class="dropdown">
                            <!-- <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown"  aria-expanded="false"><?= ucwords($this->session->userdata('username')) ?></a> -->
                        </div>
                        <p class="text-muted"><?= ucwords($this->session->userdata('role')) ?></p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">
                                    <i class="mdi mdi-cog"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="<?= base_url("Logout") ?>">
                                    <i class="mdi mdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <?php $this->load->view("menu_view") ?>
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="#details" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    <span class="d-block d-sm-none"><i class="fas fa-sticky-note"></i></span>
                                                    <span class="d-none d-sm-block">Details</span>            
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="#report" id="tab-report" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                    <span class="d-block d-sm-none"><i class="fas fa-chart-line"></i></span>
                                                    <span class="d-none d-sm-block">Report ads</span> 
                                                </a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a href="#campaign-leads" id="campaign-leads-datatable" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                    <span class="d-block d-sm-none"><i class="fas fa-clipboard-list"></i></span>
                                                    <span class="d-none d-sm-block">Campaign leads</span> 
                                                </a>
                                            </li>
                                            
                                            <?php if ( $campaign_mobile_coupon["IsAutoGenerateCouponCode"] == 0 ): ?>
                                                <li class="nav-item">
                                                    <a href="#coupon-code" id="coupon-code-list-datatable" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                        <span class="d-block d-sm-none"><i class="fas fa-code"></i></span>
                                                        <span class="d-none d-sm-block">Coupon Code</span> 
                                                    </a>
                                                </li>
                                            <?php endif ?>
                                        </ul>

                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade show active" id="details">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h4 class="mb-2">Campaign details</h4>
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Brand Name</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <h5><?= ucwords($campaign["BrandName"]) ?></h5>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                           <div class="col-lg-2">
                                                               <h5 class="text-left text-danger">Brand Logo Image</h5>
                                                           </div>

                                                           <div class="col-lg-10">
                                                            <img src="<?= $campaign["BrandLogoImage"] ?>" class="" alt="" width="20%">
                                                           </div>
                                                       </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Brand Description</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <h5><?= ucwords($campaign["BrandDescription"]) ?></h5>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Date created</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <h5><?= date("d F Y", strtotime($campaign["created"])) ?></h5>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Campaign reference</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <h5><?= $campaign["CampaignReference"] ?></h5>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Campaign image</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <?php foreach ($campaign["Image"] as $image): ?>
                                                                        <div class="col-lg-4 mr-3">
                                                                            <img src="<?= $image["ImageLocation"] ?>" class="" alt="" width="100%">
                                                                        </div>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Campaign short description</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <h5><?= ucwords($campaign["CampaignShortDescription"]) ?></h5>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Campaign start date</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <h5><?= date("d F Y", strtotime($campaign["CampaignStartDate"])) ?></h5>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Campaign end date</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <h5><?= date("d F Y", strtotime($campaign["CampaignEndDate"])) ?></h5>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Campaign landing page</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <h5><?= $campaign["LandingPageName"] ?></h5>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <h5 class="text-left text-danger">Campaign info</h5>
                                                            </div>

                                                            <div class="col-lg-10">
                                                                <h5><?= $campaign["CampaignInfo"] ?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-12">
                                                        <h4 class="mt-5 mb-2">Campaign trackers</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th width="20%" class="text-center text-danger">Short code</th>
                                                                        <th width="50%" class="text-center text-danger">Description</th>
                                                                        <th width="50%" class="text-center text-danger">URL</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if ($campaign_trackers): ?>
                                                                        <?php foreach($campaign_trackers as $tracker): ?>
                                                                            <tr>
                                                                                <td class="text-center"><?= $tracker["ShortCode"] ?></td>
                                                                                <td class="text-center"><?= ucwords($tracker["TrackerFor"]) ?></td>
                                                                                <td class="text-center">
                                                                                    lovvit.id/<?= $campaign["BrandName"] ?>/<?= $campaign["LandingPageName"] ?>?ref=<?= $tracker["ShortCode"] ?>
                                                                                </td>    
                                                                            </tr>
                                                                        <?php endforeach ?>
                                                                    <?php else: ?>
                                                                        <tr>
                                                                            <td colspan="3" class="text-center">
                                                                                <h4 class="text-muted"><i>No campaign tracker</i></h4>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endif ?>
                                                                </tbody>
                                                            </table>
                                                       </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <h4 class="mt-5 mb-2">Coupon bot settings</h4>
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <h5 class="text-left text-danger">Bot phone number</h5>
                                                                </div>

                                                                <div class="col-lg-10">
                                                                    <h5><?= !empty($campaign_mobile_coupon["BotPhoneNumber"]) ? $campaign_mobile_coupon["BotPhoneNumber"] : " - " ?></h5>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <h5 class="text-left text-danger">Wa bot request coupon text template</h5>
                                                                </div>

                                                                <div class="col-lg-10">
                                                                    <h5><?= !empty($campaign_mobile_coupon["BotRequestCouponTemplate"]) ? $campaign_mobile_coupon["BotRequestCouponTemplate"] : " - " ?></h5>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <h5 class="text-left text-danger">Success redeem coupon text reply template</h5>
                                                                </div>

                                                                <div class="col-lg-10">
                                                                <h5><?= !empty($campaign_mobile_coupon["BotSuccessRedeemCouponReplyTemplate"]) ? $campaign_mobile_coupon["BotSuccessRedeemCouponReplyTemplate"] : " - " ?></h5>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <h5 class="text-left text-danger">Coupon image template</h5>
                                                                </div>

                                                                <div class="col-lg-10">
                                                                    <?php $url = !empty($campaign_mobile_coupon["CouponTemplateImageLocation"]) ? $campaign_mobile_coupon["CouponTemplateImageLocation"] : base_url("assets/images/no-image.jpg") ?>
                                                                    <img src="<?= $url ?>" class="" alt="" width="20%">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <h5 class="text-left text-danger">Double redeem text reply template</h5>
                                                                </div>

                                                                <div class="col-lg-10">
                                                                    <h5><?= !empty($campaign_mobile_coupon["BotDoubleRedeemReplyTemplate"]) ? $campaign_mobile_coupon["BotDoubleRedeemReplyTemplate"] : " - " ?></h5>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <h5 class="text-left text-danger">failed text reply template</h5>
                                                                </div>

                                                                <div class="col-lg-10">
                                                                    <h5><?= !empty($campaign_mobile_coupon["BotFailedRedeemReplyTemplate"]) ? $campaign_mobile_coupon["BotFailedRedeemReplyTemplate"] : " - " ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane fade" id="report">
                                                <div class="row" id="report_result">
                                                       <h4>Loading data</h4>
                                                </div>
                                            </div>
                                            
                                            <div role="tabpanel" class="tab-pane fade" id="campaign-leads">
                                                <table id="datatable-leads" class="table table table-hover m-0">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th class="">#</th>
                                                            <th class="">Short code</th>
                                                            <th class="">Code coupon</th>
                                                            <th class="">Issue date</th>
                                                            <th class="">Redeem date</th>
                                                            <th class="">MSISDN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div role="tabpanel" class="tab-pane fade" id="coupon-code">
                                                <?php if ( $campaign_mobile_coupon["IsAutoGenerateCouponCode"] == 0 ): ?>
                                                    <div class="py-2" id="coupon-dashboard">
                                                       <h4>Loading statistic data...</h4>
                                                    </div>
                                                    
                                                    <a href="javascript:void(0)" class="btn width-md btn-light waves-effect waves-light text-info mb-4" data-toggle="modal" data-target="#modal-coupon-code-import">
                                                        <i class="far fa-arrow-alt-circle-up text-danger"></i> <strong class="text-danger">Import coupon code</strong>
                                                    </a>

                                                    <button class="btn width-md btn-light waves-effect waves-light text-info mb-4 btn-coupon-code-export-example-file">
                                                        <i class="far fa-arrow-alt-circle-down text-info"></i> <strong class="text-info">Export example file</strong>
                                                    </button>

                                                    <button class="btn width-md btn-light waves-effect waves-light text-info mb-4 btn-coupon-code-delete ml-4" data-id="<?= $campaign_mobile_coupon['id'] ?>">
                                                        <strong class="text-dark">Delete Coupon Code</strong>
                                                    </button>

                                                     <table id="datatable-coupon-code-list" class="table table-hover m-0" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%">#</th>
                                                                <th>Created</th>
                                                                <th>Coupon Code</th>
                                                                <th>Issued</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                <?php else: ?>

                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div><!-- end col -->

                                </div>
                                <!-- end row -->
                            </div>
                        </div><!-- end col -->
                    </div>
                </div> <!-- content -->

                <!-- Footer Start -->
                <!-- <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                               2016 - 2020 &copy; Adminto theme by <a href="">Coderthemes</a> 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer> -->
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- sample modal content -->
        <div id="modal-coupon-code-import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Import coupon code</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="form-coupon-code-import" class="form-horizontal" role="form" data-parsley-validate novalidate>
                            <input type="hidden" name="id" value="<?= $campaign["id"] ?>">
                            <input type="file" name="coupon_code" class="dropify" data-height="300" />
                        
                            <div class="text-right mt-4">
                                <button type="button" class="btn btn-sm btn-light waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn tbn-sm btn-light waves-effect waves-light text-success btn-coupon-code-import">Submit</button>
                            </div>
                        </form>
                    </div>  

                    <div class="modal-footer">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Vendor js -->
        <script src="<?= base_url() ?>assets/js/vendor.min.js"></script>

        <!-- knob plugin -->
        <script src="<?= base_url() ?>assets/libs/jquery-knob/jquery.knob.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url() ?>assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="<?= base_url() ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/buttons.flash.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables/dataTables.select.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/pdfmake/vfs_fonts.js"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="<?= base_url() ?>assets/js/pages/datatables.init.js"></script>

        <!-- dropify js -->
        <script src="<?= base_url() ?>assets/libs/dropify/dropify.min.js"></script>

        <!-- form-upload init -->
        <script src="<?= base_url() ?>assets/js/pages/form-fileupload.init.js"></script>

        <!-- Sweet Alerts js -->
        <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="<?= base_url() ?>assets/js/pages/sweet-alerts.init.js"></script>
        

        <script>
            let load_leads_datatable = () => {
                $("#datatable-leads").DataTable({
                    "aoColumnDefs": [
                        { 'bSortable': false, 'aTargets': [-1, -2] }
                    ],
                    "sAjaxSource": "<?= base_url("Campaigns/campaign_leads_datatable/". $campaign['id'] ."") ?>",
                    dom: "Bfrtip",
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm btn-light text-info"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm btn-light text-info"
                        },
                        {
                            extend: "pdf",
                            className: "btn-sm btn-light text-info"
                        },
                        {
                            extend: "print",
                            className: "btn-sm btn-light text-info",
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                    ],
                })
            }

            $(document).on("click", "#campaign-leads-datatable", function() {
                $("#datatable-leads").DataTable().destroy();
                load_leads_datatable();
            });

            let load_coupon_dashboard = (id = <?= $id ?>) => {
                $.ajax({
                    url         : "<?= base_url("Campaigns/coupon_dashboard/${id}") ?>",
                    type        : 'GET',
                    success: function(response) {
                        $("#coupon-dashboard").html(response)
                    }
                });
            }

            let load_coupon_list_datatable = () => {
                $("#datatable-coupon-code-list").DataTable({
                    "processing"    : true,
                    "serverSide"    : true,
                    "order"         : [],

                    "ajax"  : {
                        "url"   : "<?= base_url("Campaigns/coupon_code_list_datatable/". $campaign['id'] ."") ?>",
                        "type"  : "POST"
                    },

                    "columnDefs"    : [
                        { 
                            "targets"   : [ 0 ], //first column / numbering column
                            "orderable" : false, //set not orderable
                        },
                    ],
                })
            }

            
            $(document).on("click", "#coupon-code-list-datatable", function() {
                load_coupon_dashboard();
                $("#datatable-coupon-code-list").DataTable().destroy();
                load_coupon_list_datatable();
            });

            // Coupon import
            $("#form-coupon-code-import").submit(function(e) {
                e.preventDefault();
                $(".btn-coupon-code-import").html("Processing...");
                $(".btn-coupon-code-import").attr('disabled', true);
                var upload_data = new FormData($('#form-coupon-code-import')[0]);
                $.ajax({
                    url         : "<?= base_url("Campaigns/import_coupon_code") ?>",
                    type        : 'POST',
                    data        : upload_data,
                    dataType    : 'JSON',
                    cache       : false,
                    contentType : false,
                    processData : false,
                    success: function(response) {
                        if ( response.status == "success" ) {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            )
                            
                            $("#datatable-coupon-code-list").DataTable().destroy();
                            load_coupon_list_datatable();
                            load_coupon_dashboard();
                        } else if ( response.status == "error" ) {
                            Swal.fire(
                                'Sorry!',
                                response.message,
                                'danger'
                            )
                        }

                        $(".btn-coupon-code-import").html("Submit");
                        $(".btn-coupon-code-import").attr('disabled', false);
                    }
                });
            })

            $(document).on("click", ".btn-coupon-code-export-example-file", function() {
                $(".btn-coupon-code-export-example-file").html("Processing...");
                $(".btn-coupon-code-export-example-file").attr('disabled', true);
                setTimeout(function() {
                    window.location.href = "<?= base_url() ?>/example_file/lovvit_example_import_coupon_code.xlsx"
                }, 6000);

                setTimeout(function() {
                    $(".btn-coupon-code-export-example-file").html("<i class='far fa-arrow-alt-circle-down text-info'></i> <strong class='text-info'>Export example file</strong>")
                    $(".btn-coupon-code-export-example-file").attr('disabled', false)
                }, 6000);
            })

            $(document).on("click", ".btn-coupon-code-delete", function() {
                $(".btn-coupon-code-delete").html("Processing...");
                $(".btn-coupon-code-delete").attr('disabled', true);
                let id  = $(this).data("id")
                $.ajax({
                    url         : "<?= base_url("Campaigns/coupon_code_delete") ?>/" + id,
                    type        : 'POST',
                    dataType    : 'JSON',
                    cache       : false,
                    contentType : false,
                    processData : false,
                    success: function(response) {
                        if ( response.status == "success" ) {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            )

                            $("#datatable-coupon-code-list").DataTable().destroy();
                            load_coupon_list_datatable();
                        } else if ( response.status == "error" ) {
                            Swal.fire(
                                'Sorry!',
                                response.message,
                                'danger'
                            )
                        }

                        $(".btn-coupon-code-delete").html("Delete Coupon Code");
                        $(".btn-coupon-code-delete").attr('disabled', false);
                    }
                });
            })

            $(document).on("click", "#tab-report", function() {
                $.ajax({
                    url         : "<?= base_url("Campaigns/campaign_report/${id}") ?>",
                    type        : 'GET',
                    success: function(response) {
                        $("#report_result").html(response)
                    }
                });
            })
                
        </script>
    </body>
</html>