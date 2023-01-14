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
                                                <a href="#list" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    <span class="d-block d-sm-none"><i class="fas fa-list-ol"></i></span>
                                                    <span class="d-none d-sm-block">List</span>            
                                                </a>
                                            </li>
                                            <!-- <li class="nav-item">
                                                <a href="#report-ads" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Report ads</span> 
                                                </a>
                                            </li> -->
                                        </ul>

                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade show active" id="list">
                                                <table id="datatable-campaign-list" class="table table table-hover m-0">
                                                    <thead class="thead-dark">
                                                            <tr>
                                                                <th class="">#</th>
                                                                <th class="">Create Date</th>
                                                                <th class="">Name</th>
                                                                <th class="">Start Date</th>
                                                                <th class="">End Date</th>
                                                                <th class="">Status</th>
                                                                <th class=""></th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- <div role="tabpanel" class="tab-pane fade" id="report-ads">
                                                <p class="mb-0">Food truck fixie locavore,
                                                accusamus mcsweeney's marfa nulla single-origin coffee squid.
                                                Exercitation +1 labore velit, blog sartorial PBR leggings next level
                                                wes anderson artisan four loko farm-to-table craft beer twee. Qui
                                                photo booth letterpress, commodo enim craft beer mlkshk aliquip jean
                                                shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda
                                                labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia
                                                yr, vero magna velit sapiente labore stumptown. Vegan fanny pack
                                                odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY
                                                ethical culpa terry richardson biodiesel. Art party scenester
                                                stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed
                                                echo park.</p>
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
        

        <script>
            $(document).ready( function() {
                $("#datatable-campaign-list").DataTable({
                    "aoColumnDefs": [
                        { 'bSortable': false, 'aTargets': [-1, -2] }
                    ],
                    "sAjaxSource": "<?= base_url("Campaigns/campaign_list_datatable") ?>",
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
            });
        </script>
    </body>
</html>