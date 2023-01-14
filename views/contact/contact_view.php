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

        <!-- dropify -->
        <link href="<?= base_url() ?>assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <!-- third party css -->
        <link href="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo logo-dark text-center">
                        <span class="logo-lg">
                            <img src="<?= base_url() ?>assets/images/logo-dark.png" alt="" height="16">
                        </span>
                        <span class="logo-sm">
                            <img src="<?= base_url() ?>assets/images/logo-sm.png" alt="" height="24">
                        </span>
                    </a>
                    <a href="index.html" class="logo logo-light text-center">
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
                        <img src="<?= base_url() ?>assets/images/blank-pic.png" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
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
                                                <a href="#list" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">List</span>            
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="#tags" id="tab-tag" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Tags</span> 
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade show active" id="list">
                                                <table class="table table table-hover m-0" id="contact_list_datatable">
                                                    <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name</th>
                                                                <th>Address</th>
                                                                <th>Handphone</th>
                                                                <th>Email</th>
                                                                <th>Tags</th>
                                                                <th></th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Rudi</td>
                                                            <td> - </td>
                                                            <td> - </td>
                                                            <td> +6285298877788 </td>
                                                            <td class="">BogoJan</td>
                                                            <td><a href="javascript:void(0)" class="btn width-md btn-light waves-effect waves-light text-info"><i class="fas fa-angle-double-right"></i> Details</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div role="tabpanel" class="tab-pane fade" id="tags">
                                                <a href="javascript:void(0)" class="btn width-md btn-light waves-effect waves-light text-info mb-2" data-toggle="modal" data-target="#modal-add-contact-tags">
                                                    <i class="far fa-arrow-alt-circle-up text-danger"></i> <strong class="text-danger">Add contact tags</strong>
                                                </a>

                                                <table class="table table table-hover m-0" id="tag_list_datatable">
                                                    <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th width="50%">Name</th>
                                                                <th>Count</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Customer</td>
                                                            <td>340</td>
                                                            <td>
                                                                <div class="text-right">
                                                                    <a href="javascript:void(0)" class="btn width-md btn-light waves-effect waves-light text-info"><i class="fas fa-angle-double-right"></i> Details</a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-left">
                                                                    <a href="javascript:void(0)" class="btn width-md btn-light waves-effect waves-light text-danger btn-tag-delete" data-id=1 id="">
                                                                        <i class="fas fa-angle-double-right"></i>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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

        <!-- modal contacts import -->
        <div id="modal-contacts-import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Import contacts</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" data-parsley-validate novalidate>
                            <input type="file" class="dropify" data-height="300" />
                        </form>
                    </div>  

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn tbn-sm btn-light waves-effect waves-light text-success">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

         <!-- modal add tag -->
        <div id="modal-add-contact-tags" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add contact tags</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" data-parsley-validate novalidate id="form-add-contact-tags">
                            <div class="form-group row">
                                <label for="tag_name" class="col-sm-3 col-form-label">Tag Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tag_name" id="tag_name" placeholder="Enter tag name">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-light waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn tbn-sm btn-light waves-effect waves-light text-success" id="btn-add-contact-tags">Submit</button>
                            </div>
                        </form>
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

        <!-- dropify js -->
        <script src="<?= base_url() ?>assets/libs/dropify/dropify.min.js"></script>

        <!-- form-upload init -->
        <script src="<?= base_url() ?>assets/js/pages/form-fileupload.init.js"></script>

        <!-- Sweet Alerts js -->
        <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="<?= base_url() ?>assets/js/pages/sweet-alerts.init.js"></script>

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
        
        <script>
            // Contact list datatable
            let load_contact_list_datatable = () => {
                $("#contact_list_datatable").DataTable({
                    "aoColumnDefs": [
                        { 'bSortable': false, 'aTargets': [-1, -2] }
                    ],
                    "sAjaxSource": "<?= base_url('Contacts/list_datatable') ?>",
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

            // Load
            $(document).ready(function() {
                load_contact_list_datatable()
            })

            // Tag list datatable
            let load_tag_list_datatable = () => {
                $("#tag_list_datatable").DataTable({
                    "aoColumnDefs": [
                        { 'bSortable': false, 'aTargets': [-1, -2] }
                    ],
                    "sAjaxSource": "<?= base_url('Contacts/tag_list_datatable') ?>",
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

            // load tag datatable
            $(document).on("click", "#tab-tag", function() {
                $("#tag_list_datatable").DataTable().destroy()
                load_tag_list_datatable()
            })

            // Tag save
            $("#form-add-contact-tags").submit(function(e) {
                e.preventDefault()
                $("#btn-add-contact-tags").attr('disabled', true)
                let data = $('#form-add-contact-tags').serializeArray()
                $.ajax({
                    url         : "<?= base_url("Contacts/tag_save") ?>",
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
                            $("#modal-add-contact-tags").modal("hide");

                            // $("#text-auto-reply-datatable").DataTable().destroy();
                            // load_text_auto_reply_datatable()
                        } else if (response.status == 'error') {
                            Swal.fire(
                                'Sorry!',
                                response.message,
                                'error'
                            )
                        }

                        $("#btn-add-contact-tags").attr('disabled', false)
                        $('#btn-add-contact-tags').html("<strong class='text-success'>Submit</strong>")
                    }
                })
            })

            // Tag delete
            $(document).on("click", ".btn-tag-delete", function() {
                let id      = $(this).data("id")
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
                            url     : "<?= base_url("Contacts/tag_delete/") ?>" + id,
                            type    : 'POST',
                            success : function(response) {
                                result = JSON.parse(response)
                                if (result.status == 'success') {
                                    Swal.fire(
                                        'Success!',
                                        result.message,
                                        'success'
                                    )

                                    // $("#text-auto-reply-datatable").DataTable().destroy();
                                    // load_text_auto_reply_datatable()
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
    </body>
</html>