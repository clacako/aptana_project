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

    </head>


    <body class="authentication-bg" style="background-image: none;">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center">
                            <a href="index.html" class="logo">
                                <img src="<?= base_url() ?>assets/images/logo-lovvit-id.png" alt="" height="50" class="logo-light mx-auto">
                               <!-- <img src="<?= base_url() ?>assets/images/logo-dark.png" alt="" height="22" class="logo-dark mx-auto"> -->
                            </a>
                            <p class="text-muted mt-2 mb-4"></p>
                        </div>
                        <div class="card">

                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Sign Up</h4>
                                </div>

                                <?php if ( $this->session->flashdata("notif") ): ?>
                                    <div class="alert alert-<?= $this->session->flashdata('notif')["type"] ?>">
                                        <?= $this->session->flashdata('notif')["message"] ?>.
                                    </div>
                                <?php endif ?>

                                <form action="<?= base_url('SignUp/run') ?>" method="POST">
                                    <input class="form-control mb-2" type="hidden" id="id_organization" name="organization" required="" value="<?= !empty($organization_id) ? $organization_id : "" ?>" readonly>
                                    <input class="form-control mb-2" type="hidden" id="id_application" name="application" required="" value="<?= !empty($application_role) ? $application_role : "" ?>" readonly>
                                    <div class="form-group mb-3">
                                        <label for="id_email">Email</label>
                                        <input class="form-control" type="email" id="id_email" name="email" required="" placeholder="Enter email">
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="">Create password</label>
                                        <input class="form-control mb-2" type="password" id="id_password" name="password" required="" placeholder="Enter password">
                                        <input class="form-control" type="password" id="id_re_password" name="re_password" required="" placeholder="Retype password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button type="submit" class="btn btn-light btn-block waves-effect mb-3"><strong class="text-info">Sign Up</strong></button>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
    

        <!-- Vendor js -->
        <script src="<?= base_url() ?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url() ?>assets/js/app.min.js"></script>
        
    </body>
</html>