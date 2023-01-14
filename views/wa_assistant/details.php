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
        <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="<?= base_url() ?>assets/css/bootstrap-dark.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?= base_url() ?>assets/css/app-dark.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />

        <!-- Custom box css -->
        <link href="<?= base_url() ?>assets/libs/custombox/custombox.min.css" rel="stylesheet">

        <!-- Plugins css -->
        <link href="<?= base_url() ?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url() ?>assets/libs/multiselect/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/libs/switchery/switchery.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- third party css -->
        <link href="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

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
                        </a>
                    </li>

                    <li>
                        <h4 class="page-title-main text-danger"><?= $header ?></h4>
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
                                                <a href="#console" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    <span class="d-block d-sm-none"><i class="fas fa-dot-circle"></i></span>
                                                    <span class="d-none d-sm-block">Console</span>            
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="#automation" id="automation-datatable" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                    <span class="d-block d-sm-none"><i class="fas fa-wrench"></i></span>
                                                    <span class="d-none d-sm-block">Automation</span> 
                                                </a>
                                            </li>

                                            <!-- <li class="nav-item">
                                                <a href="#report" id="" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                    <span class="d-block d-sm-none"><i class="fas fa-wrench"></i></span>
                                                    <span class="d-none d-sm-block">Report</span> 
                                                </a>
                                            </li> -->
                                        </ul>

                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade show active" id="console">
                                                <?php if ( !empty($wa_assistant) ): ?>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <?php
                                                                $status_class = "";
                                                                switch ($wa_assistant["status"]) {
                                                                    case 'Online':
                                                                        $status_class = "<span class='text-info ml-4'>Online</span>";
                                                                        break;
                                                                    
                                                                    case 'Connected':
                                                                        $status_class = "<span class='text-success ml-4'>Connected</span>";
                                                                        break;

                                                                    case 'Offline':
                                                                        $status_class = "<span class='text-danger ml-4'>Offline</span>";
                                                                        break;

                                                                    default:
                                                                        # code...
                                                                        break;
                                                                }
                                                            ?>
                                                            <h4>Status : <?= $status_class ?></h4>

                                                            <?php if ( $wa_assistant["status"] == "Offline" ): ?>
                                                                <a href="javascript:void(0)" class="btn btn-xs btn-secondary waves-effect waves-light text-right bot-turn-on" data-id="<?= $wa_assistant["BotID"] ?>"><i class="fas fa-play-circle text-success"></i> Turn on</a>
                                                            <?php else: ?>
                                                                <a href="javascript:void(0)" class="btn btn-xs btn-secondary waves-effect waves-light text-right bot-turn-off" data-id="<?= $wa_assistant["BotID"] ?>"><i class="fas fa-stop-circle text-danger"></i> Turn off</a>
                                                                <a href="javascript:void(0)" class="btn btn-xs btn-secondary waves-effect waves-light" data-bot_id="<?= $wa_assistant["BotID"] ?>" id="btn-modal-qr-code"><i class="fas fa-qrcode"></i> Scan QRCODE</a>
                                                            <?php endif ?>
                                                        
                                                        </div>
                                                    </div>

                                                <?php endif ?>
                                            </div>
                                            
                                            <div role="tabpanel" class="tab-pane fade" id="automation">
                                                <h5 class="header-title text-danger mb-3">Campaign auto reply</h5>
                                                <table class="table table table-hover m-0" id="campaign-auto-reply-datatable">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Keyword triggers</th>
                                                            <th>Case sensitive</th>
                                                            <th>Pattern</th>
                                                            <th>Campaign name</th>
                                                            <th>Campaign status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>

                                                <div class="mt-5">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h5 class="text-danger">Text auto reply</h5>
                                                        </div>
                                                        
                                                        <div class="col-lg-6 text-right">
                                                            <a href="javascript:void(0)" class="btn width-md btn-light waves-effect waves-light text-info mb-2" data-id=<?= $wa_assistant["id"] ?> data-bot_id="<?= $wa_assistant["BotID"] ?>" id="btn-text-auto-reply">
                                                                <i class="far fa-arrow-alt-circle-up text-danger"></i>
                                                                <strong class="text-danger">Add auto text reply</strong>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table class="table table table-hover m-0" id="text-auto-reply-datatable">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Keyword triggers</th>
                                                            <th>Case sensitive</th>
                                                            <th>Pattern</th>
                                                            <th>Reply type</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div role="tabpanel" class="tab-pane fade" id="report">
                                                <h4>Report page</h4>
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

        <!-- modal text auto reply -->
        <div id="modal-text-auto-reply" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div id="modal-content-text-auto-reply"></div>
        </div><!-- /.modal -->

        <!-- modal qr code -->
        <div id="modal-qr-code" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div id="qr-code-result"></div>
        </div><!-- /.modal -->

        <!-- Vendor js -->
        <script src="<?= base_url() ?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url() ?>assets/js/app.min.js"></script>

        <!-- Modal-Effect -->
        <script src="<?= base_url() ?>assets/libs/custombox/custombox.min.js"></script>

        <!-- Plugins Js -->
        <script src="<?= base_url() ?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/switchery/switchery.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/multiselect/jquery.multi-select.js"></script>
        <script src="<?= base_url() ?>assets/libs/jquery-quicksearch/jquery.quicksearch.min.js"></script>

        <script src="<?= base_url() ?>assets/libs/select2/select2.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/moment/moment.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

        <!-- Init js-->
        <script src="<?= base_url() ?>assets/js/pages/form-advanced.init.js"></script>

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

        <!-- Sweet Alerts js -->
        <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="<?= base_url() ?>assets/js/pages/sweet-alerts.init.js"></script>
        
        <script>
            // campaign auto reply datatable
            let load_campaign_auto_reply_datatable = () => {
                $("#campaign-auto-reply-datatable").DataTable({
                    "aoColumnDefs": [
                        { 'bSortable': false, 'aTargets': [-1, -2] }
                    ],
                    "sAjaxSource": "<?= base_url("WaAssistant/campaign_auto_reply_datatable/". $wa_assistant["BotID"] ."") ?>",
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

            // load text auto reply datatable
            let load_text_auto_reply_datatable = () => {
                $("#text-auto-reply-datatable").DataTable({
                    "aoColumnDefs": [
                        { 'bSortable': false, 'aTargets': [-1, -2] }
                    ],
                    "sAjaxSource": "<?= base_url("WaAssistant/text_auto_reply_datatable/". $wa_assistant["BotID"] ."") ?>",
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

            // load automation datatable
            $(document).on("click", "#automation-datatable", function() {
                $("#campaign-auto-reply-datatable").DataTable().destroy()
                $("#text-auto-reply-datatable").DataTable().destroy()
                load_campaign_auto_reply_datatable()
                load_text_auto_reply_datatable()
            });

            // Text auto reply delete
            $(document).on("click", ".btn-text-auto-reply-delete", function() {
                let id      = $(this).data("id")
                let bot_id  = $(this).data("bot_id")
                Swal.fire({
                    title: 'Are you sure?',
                    text: "It will permanently deleted !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "<?= base_url("WaAssistant/text_auto_reply_delete/") ?>" + bot_id + "/" + id,
                            type    : 'POST',
                            success : function(response) {
                                result = JSON.parse(response)
                                if (result.status == 'success') {
                                    Swal.fire(
                                        'Success!',
                                        result.message,
                                        'success'
                                    )

                                    $("#text-auto-reply-datatable").DataTable().destroy();
                                    load_text_auto_reply_datatable()
                                } else if (result.status == 'error') {
                                    Swal.fire(
                                        'Sorry!',
                                        result.message,
                                        'error'
                                    )
                                }
                            }
                        })
                    }
                });
            });

            // btn-campaign-auto-reply-delete
            $(document).on("click", ".btn-campaign-auto-reply-delete", function() {
                let id      = $(this).data("id")
                let bot_id  = $(this).data("bot_id")
                Swal.fire({
                    title: 'Are you sure?',
                    text: "It will permanently deleted !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "<?= base_url("WaAssistant/campaign_auto_reply_delete/") ?>" + bot_id + "/" + id,
                            type    : 'POST',
                            success : function(response) {
                                result = JSON.parse(response)
                                if (result.status == 'success') {
                                    Swal.fire(
                                        'Success!',
                                        result.message,
                                        'success'
                                    )

                                    $("#campaign-auto-reply-datatable").DataTable().destroy();
                                    load_campaign_auto_reply_datatable()
                                } else if (result.status == 'error') {
                                    Swal.fire(
                                        'Sorry!',
                                        result.message,
                                        'error'
                                    )
                                }
                            }
                        })
                    }
                });
            });

            let bot_id = ""
            var load_qr_code;

            // Modal qr code
            $(document).on("click", "#btn-modal-qr-code", function() {
                let bot_id  = $(this).data("bot_id")
                $.ajax({
                    url     : "<?= base_url("WaAssistant/qr_code/") ?>" + bot_id,
                    type    : "GET",
                    success : function(response) {
                        $("#qr-code-result").html(response);
                        $("#modal-qr-code").modal("show");
                        
                        load_qr_code = setInterval(() => {
                        $.ajax({
                            url     : "<?= base_url("WaAssistant/qr_code/") ?>" + bot_id,
                            type    : "GET",
                            success : function(response) {
                                $("#qr-code-result").html(response);
                            }
                        });
                        }, 7000);
                    }
                });
            });

            // Modal qr code close
            $(document).on("click", ".modal-close", function() {
                clearInterval(load_qr_code)
            });

            // Bot turn on
            $(document).on("click", ".bot-turn-on", function() {
                let id  = $(this).data("id")
                $('.bot-turn-on').html("Process")
                $(".bot-turn-on").attr('disabled', true)
                $.ajax({
                    url     : "<?= base_url("WaAssistant/bot_turn_on/") ?>" + id,
                    type    : "POST",
                    success : function(response) {
                        result = JSON.parse(response)
                        if (result.status == 'success') {
                            console.log(result.message);
                            Swal.fire(
                                'Success!',
                                result.message,
                                'success'
                            )

                            $('.bot-turn-on').html("Reloading")
                            $(".bot-turn-on").attr('disabled', true)
                            setInterval(function() { location.reload(); }, 3000)
                        } else if (result.status == 'error') {
                            Swal.fire(
                                'Sorry!',
                                result.message,
                                'error'
                            )

                            $('.bot-turn-on').html("Error")
                            $(".bot-turn-on").attr('disabled', false)
                        }
                    }
                });
            });

            // Bot turn off
            $(document).on("click", ".bot-turn-off", function() {
                let id  = $(this).data("id")
                $('.bot-turn-off').html("Process")
                $(".bot-turn-off").attr('disabled', true)
                $.ajax({
                    url     : "<?= base_url("WaAssistant/bot_turn_off/") ?>" + id,
                    type    : "POST",
                    success : function(response) {
                        result = JSON.parse(response)
                        if (result.status == 'success') {
                            console.log(result.message);
                            Swal.fire(
                                'Success!',
                                result.message,
                                'success'
                            )

                            $('.bot-turn-off').html("Reloading")
                            $(".bot-turn-off").attr('disabled', true)
                            setInterval(function() { location.reload(); }, 3000)
                        } else if (result.status == 'error') {
                            Swal.fire(
                                'Sorry!',
                                result.message,
                                'error'
                            )

                            $('.bot-turn-off').html("Error")
                            $(".bot-turn-off").attr('disabled', false)
                        }
                    }
                });
            });

            // Modal text auto reply
            $(document).on("click", "#btn-text-auto-reply", function() {
                let id      = $(this).data("id")
                let bot_id  = $(this).data("bot_id")
                // console.log(bot_id)
                $.ajax({
                    url     : "<?= base_url("WaAssistant/modal_text_auto_reply/") ?>" + bot_id + "/" + id,
                    type    : "GET",
                    success : function(response) {
                        $("#modal-content-text-auto-reply").html(response);
                        $(".pattern-select2").select2();
                        $("#modal-text-auto-reply").modal("show");
                    }
                });
            });

            // Text auto reply save
            $(document).on("click", "#btn-text-auto-reply-save", function(e) {
                e.preventDefault();
                $('#btn-text-auto-reply-save').html("Process...")
                $("#btn-text-auto-reply-save").attr('disabled', true)
                let data = $('#form-text-auto-reply-save').serializeArray();
                $.ajax({
                    url         : "<?= base_url("WaAssistant/text_auto_reply_save") ?>",
                    type        : 'POST',
                    data        : data,
                    dataType    : "JSON",
                    cache       : false,
                    success     : function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            )
                            $("#text-auto-reply-datatable").DataTable().destroy();
                            load_text_auto_reply_datatable()
                            $("#modal-text-auto-reply").modal("hide");
                        } else if (response.status == 'error') {
                            Swal.fire(
                                'Sorry!',
                                response.message,
                                'error'
                            )
                        }

                        $("#btn-text-auto-reply-save").attr('disabled', false)
                        $('#btn-text-auto-reply-save').html("<strong class='text-success'>Submit</strong>")
                    }
                })
            });

            // Text auto reply update
            $(document).on("click", "#btn-text-auto-reply-update", function(e) {
                e.preventDefault();
                $('#btn-text-auto-reply-update').html("Process...")
                $("#btn-text-auto-reply-update").attr('disabled', true)
                let data = $('#form-text-auto-reply-save').serializeArray();
                $.ajax({
                    url         : "<?= base_url("WaAssistant/text_auto_reply_update") ?>",
                    type        : 'POST',
                    data        : data,
                    dataType    : "JSON",
                    cache       : false,
                    success     : function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            )
                            $("#text-auto-reply-datatable").DataTable().destroy();
                            load_text_auto_reply_datatable()
                            $("#modal-text-auto-reply").modal("hide");
                        } else if (response.status == 'error') {
                            Swal.fire(
                                'Sorry!',
                                response.message,
                                'error'
                            )
                        }

                        $("#btn-text-auto-reply-update").attr('disabled', false)
                        $('#btn-text-auto-reply-update').html("<strong class='text-success'>Update</strong>")
                    }
                })
            });

        </script>

    </body>
</html>