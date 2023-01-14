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
                            <img src="<?= base_url() ?>assets/images/logo-lovvit-id.png" alt="" height="24">
                        </span>
                    </a>
                    <a href="<?= base_url("Campaigns") ?>" class="logo logo-light text-center">
                        <span class="logo-lg">
                            <img src="<?= base_url() ?>assets/images/logo-lovvit-id.png" alt="" height="24">
                        </span>
                        <span class="logo-sm">
                            <img src="<?= base_url() ?>assets/images/logo-lovvit-id.png" alt="" height="24">
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
                                        <a href="javascript:void(0)" class="btn width-md btn-light waves-effect waves-light text-info mb-2" data-member_number=0 id="btn-user-invitation">
                                            <i class="far fa-arrow-alt-circle-up text-danger"></i> <strong class="text-danger">Invite new user</strong>
                                        </a>

                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="#user" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">User</span>            
                                                </a>
                                            </li>
                                            <!-- <li class="nav-item">
                                                <a href="#licenses" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Licenses</span> 
                                                </a>
                                            </li> -->
                                        </ul>

                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade show active" id="user">
                                                <table id="datatable-user-list" class="table table table-hover m-0">
                                                    <thead>
                                                            <tr>
                                                                <th width="5%">#</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Status</th>
                                                                <th>Access</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <!-- <div role="tabpanel" class="tab-pane fade" id="licenses">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <h5 class="text-right text-danger">Saat ini license anda</h5>
                                                    </div>

                                                    <div class="col-lg-8">
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-light waves-effect waves-light text-success text-uppercase"><strong>Basic plus</strong></a>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <h5 class="text-right text-danger">Valid hingga</h5>
                                                    </div>

                                                    <div class="col-lg-8">
                                                        <h5>31 December 2021</h5>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <h5 class="text-right text-danger">Autorenew</h5>
                                                    </div>

                                                    <div class="col-lg-8">
                                                        <h5>Basic plus</h5>
                                                    </div>
                                                </div>
                                            </div> -->
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
        <div id="modal-user-invitation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div id="modal-body-user-invitation"></div>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Vendor js -->
        <script src="<?= base_url() ?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url() ?>assets/js/app.min.js"></script>

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
        
    </body>

    <script>
        // Modal user
        $(document).on("click", "#btn-user-invitation", function(){
            let member_number = $(this).data("member_number")
            $.ajax({
                url     : "<?= base_url('Settings/member_modal_invitation/') ?>" + member_number,
                type    : 'GET',
                success : function(response) {
                    $(".role-list-select2").select2()
                    $("#modal-body-user-invitation").html(response)
                    $("#modal-user-invitation").modal("show")
                }
            });
        })

        
        let load_user_list_datatable = () => $("#datatable-user-list").DataTable({
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [-1, -2] }
            ],
            "sAjaxSource": "<?= base_url("Settings/member_list_datatable") ?>",
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
        
        load_user_list_datatable();

        // Send invitation member
        $(document).on("click", "#btn-send-invitation-member", function(e) {
            e.preventDefault();
            $('#btn-send-invitation-member').html("<span class='fa fa-circle-o-notch fa-spin'></span> Process...")
            $("#btn-send-invitation-member").attr('disabled', true)
            let data = $('#form-send-invitation-member').serializeArray();
            $.ajax({
                url: "<?= base_url("Settings/member_send_invitation") ?>",
                type: 'POST',
                data: data,
                dataType: "JSON",
                cache: false,
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire(
                            'Success!',
                            response.message,
                            'success'
                        )
                        $("#modal-user-invitation").modal("hide")
                    } else if (response.status == 'error') {
                        Swal.fire(
                            'Sorry!',
                            response.message,
                            'error'
                        )
                    }

                    $("#btn-send-invitation-member").attr('disabled', false)
                    $('#btn-send-invitation-member').html("<strong class='text-success'>Send</strong>")
                }
            })
        });

        // Save member
        $(document).on("click", "#btn-save-member", function(e) {
            e.preventDefault();
            $('#btn-save-member').html("<span class='fa fa-circle-o-notch fa-spin'></span> Process...")
            $("#btn-save-member").attr('disabled', true)
            let data = $('#form-send-invitation-member').serializeArray();
            $.ajax({
                url: "<?= base_url("Settings/member_save") ?>",
                type: 'POST',
                data: data,
                dataType: "JSON",
                cache: false,
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire(
                            'Success!',
                            response.message,
                            'success'
                        )
                        $("#modal-user-invitation").modal("hide")
                        $("#datatable-user-list").DataTable().destroy();
                        load_user_list_datatable()
                    } else if (response.status == 'error') {
                        Swal.fire(
                            'Sorry!',
                            response.message,
                            'error'
                        )
                    }

                    $("#btn-save-member").attr('disabled', false)
                    $('#btn-save-member').html("<strong class='text-success'>Send</strong>")
                }
            })
        });
        

        // Delete user
        $(document).on("click", ".btn-user-delete", function() {
                let member_number   = $(this).data("member_number")
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
                            url     : "<?= base_url("Settings/member_delete/") ?>" + member_number,
                            type    : 'POST',
                            success : function(response) {
                                result = JSON.parse(response)
                                if (result.status == 'success') {
                                    Swal.fire(
                                        'Success!',
                                        result.message,
                                        'success'
                                    )

                                    $("#datatable-user-list").DataTable().destroy();
                                    load_user_list_datatable()
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
    </script>
</html>