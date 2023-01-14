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
						<h4 class="page-title-main text-danger"><?= $header ?? null ?></h4>
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
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a href="#dashboard" data-toggle="tab" aria-expanded="true" class="nav-link active">
									<span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
									<span class="d-none d-sm-block">Dashboard</span>            
								</a>
							</li>

							<?php if ( !empty($brand_url) ): ?>
								<li class="nav-item">
									<a href="#design" data-toggle="tab" aria-expanded="false" class="nav-link">
										<span class="d-block d-sm-none"><i class="far fa-user"></i></span>
										<span class="d-none d-sm-block">Design</span> 
									</a>
								</li>
								<li class="nav-item">
									<a href="#report" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="far fa-user"></i></span>
										<span class="d-none d-sm-block">Report</span> 
									</a>
								</li>
							<?php endif ?>
						</ul>

						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade show active" id="dashboard">
								<p class="mb-0">
								</p>
							</div>

							<?php if ( !empty($brand_url) ): ?>
								<div role="tabpanel" class="tab-pane fade" id="design">
									<p class="mb-0">
										<?php if ( $this->session->flashdata("notif") ): ?>
											<div class="alert alert-<?= $this->session->flashdata('notif')["type"] ?>">
												<?= $this->session->flashdata('notif')["message"] ?>.
											</div>
										<?php endif ?>
									</p>
								</div>

								<div role="tabpanel" class="tab-pane fade" id="report">
									<p class="mb-0">
										
									</p>
								</div>
							<?php endif ?>
						</div>
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
	</body>
</html>
<!-- Vendor js -->
<script src="<?= base_url() ?>assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="<?= base_url() ?>assets/js/app.min.js"></script>

<!-- Validation js (Parsleyjs) -->
<script src="<?= base_url() ?>assets/libs/parsleyjs/parsley.min.js"></script>

<!-- validation init -->
<script src="<?= base_url() ?>assets/js/pages/form-validation.init.js"></script>

<script src="<?= base_url() ?>assets/js/custom.js"></script>

<!-- Sweet Alerts js -->
<script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="<?= base_url() ?>assets/js/pages/sweet-alerts.init.js"></script>

<script>
	$(document).ready(function () {
		load_dashboard_content();
		load_design_content();
		load_report_content();
	});

	function load_dashboard_content() {
		$(".tab-content #dashboard").html("loading content...")
		// get dashboard content
		let url = "<?= base_url()."LandingPageBuilder/load_dashboard_content" ?>";
		let id = "<?= $brand_details['id'] ?? null ?>";
		$.get(
			url,
			{id: id},
			function(resp) {
				$(".tab-content #dashboard").html(resp)
			}
		);
	}

	function load_design_content() {
		$(".tab-content #design").html("loading content...")
		// get design content
		let url = "<?= base_url()."LandingPageBuilder/load_design_content" ?>";
		let id = "<?= $brand_details['id'] ?? null ?>";
		$.get(
			url,
			{id: id},
			function(resp) {
				$(".tab-content #design").html(resp)
			}
		);
	}

	function load_report_content() {
		$(".tab-content #report").html("loading content...")
		// get design content
		let url = "<?= base_url()."LandingPageBuilder/load_report_content" ?>";
		let id = "<?= $brand_details['id'] ?? null ?>";
		$.get(
			url,
			{id: id},
			function(resp) {
				$(".tab-content #report").html(resp)
			}
		);
	}
</script>